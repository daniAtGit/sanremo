<?php

namespace App\Models;

use App\Enums\TipoCanzone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Artista extends Model
{
    use HasUuids;

    protected $table="artisti";

    protected $fillable = [
        'nome',
        'tipo_id',
        'wikipedia',
    ];

    protected $casts = [
        //
    ];

    public function edizioni(): BelongsToMany
    {
        return $this->belongsToMany(Edizione::class, 'artista_edizione')->withPivot('ruolo');
    }

    public function canzoni(): BelongsToMany
    {
        return $this->belongsToMany(Canzone::class, 'canzone_artista');
    }

    public function tipoArtista(): BelongsTo
    {
        return $this->belongsTo(\App\Models\TipoArtista::class, 'tipo_id', 'id');
    }

    public function socials()
    {
        return $this->morphMany(Social::class, 'socialable');
    }

    public function getImgArtistaFromGoogle($cosa = null, $anno = null)
    {
        return $this->getImgArtistaFromWikimedia($cosa, $anno);
    }

    public function getImgArtistaFromWiki($cosa = null, $anno = null)
    {
        return $this->getImgArtistaFromWikimedia($cosa, $anno);
    }

    private function getImgArtistaFromWikimedia($cosa = null, $anno = null): ?string
    {
        $fromTitle = $this->getImageFromWikipediaTitle();
        if (!empty($fromTitle)) {
            return $fromTitle;
        }

        $terms = array_filter([
            trim($this->nome.' '.($cosa ?? '').' '.($anno ?? '')),
            $this->nome.' cantante',
            $this->nome,
        ]);

        foreach ($terms as $term) {
            $url = $this->getImageFromWikipediaSearch($term);
            if (!empty($url)) {
                return $url;
            }
        }

        return null;
    }

    private function getImageFromWikipediaTitle(): ?string
    {
        $title = $this->extractWikipediaTitleFromUrl();
        if (empty($title)) {
            return null;
        }

        try {
            $response = $this->wikiHttp()->get('https://it.wikipedia.org/w/api.php', [
                'action' => 'query',
                'format' => 'json',
                'redirects' => 1,
                'prop' => 'pageimages',
                'piprop' => 'original|thumbnail',
                'pithumbsize' => 600,
                'titles' => $title,
            ]);

            if (!$response->ok()) {
                return null;
            }

            $pages = $response->json('query.pages', []);
            foreach ($pages as $page) {
                $url = $page['original']['source'] ?? $page['thumbnail']['source'] ?? null;
                if (!empty($url)) {
                    return $url;
                }
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return null;
    }

    private function getImageFromWikipediaSearch(string $search): ?string
    {
        try {
            $response = $this->wikiHttp()->get('https://it.wikipedia.org/w/api.php', [
                'action' => 'query',
                'format' => 'json',
                'generator' => 'search',
                'gsrsearch' => $search,
                'gsrnamespace' => 0,
                'gsrlimit' => 5,
                'prop' => 'pageimages',
                'piprop' => 'original|thumbnail',
                'pithumbsize' => 600,
            ]);

            if (!$response->ok()) {
                return null;
            }

            $pages = collect($response->json('query.pages', []));
            foreach ($pages as $page) {
                $url = data_get($page, 'original.source') ?? data_get($page, 'thumbnail.source');
                if (!empty($url)) {
                    return $url;
                }
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return null;
    }

    private function extractWikipediaTitleFromUrl(): ?string
    {
        if (empty($this->wikipedia)) {
            return null;
        }

        $path = parse_url($this->wikipedia, PHP_URL_PATH);
        if (empty($path) || !str_contains($path, '/wiki/')) {
            return null;
        }

        $title = substr($path, strpos($path, '/wiki/') + 6);
        $title = urldecode(str_replace('_', ' ', $title));

        return $title ?: null;
    }

    private function wikiHttp(): PendingRequest
    {
        $userAgent = env('WIKIMEDIA_USER_AGENT', 'SanremoArchivioBot/1.0 (https://localhost; mailto:admin@example.com)');

        return Http::timeout(8)
            ->retry(2, 250)
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->withUserAgent($userAgent);
    }

    public function isCantante()
    {
        return $this->canzoni->count();
    }

    public function getConduzione()
    {
        return $this->edizioni->pluck('pivot')->where('ruolo','conduttore')->count();
    }

    public function getCoconduzione()
    {
        return $this->edizioni->pluck('pivot')->where('ruolo','coconduttore')->count();
    }

    public function getOspitate()
    {
        return $this->edizioni->pluck('pivot')->where('ruolo','ospite')->count();
    }

    public function getPartecipazioni()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->count();
    }

    public function getVittorie()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->where('posizione',1)->count();
    }

    public function getSecondiPosto()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->where('posizione',2)->count();
    }

    public function getTerziPosto()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->where('posizione',3)->count();
    }

    public function getEurovision()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->whereNotNull('posizione_eurovision')->count();
    }

    public function getPremi()
    {
        return $this->canzoni->pluck('premi')->collapse()->count();
    }

    public function getUltimaEdizione()
    {
        return $this->canzoni->where('tipo',TipoCanzone::GARA)->pluck('edizione')->sortByDesc('anno')->first();
    }
}
