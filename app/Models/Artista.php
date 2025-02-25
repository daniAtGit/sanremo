<?php

namespace App\Models;

use App\Enums\TipoCanzone;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use Illuminate\Support\Str;

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
        $file = "https://www.google.com/search?q=".Str::replace(" ","+",$this->nome)."+".$cosa."+".$anno."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[2]->src ?? null;
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
}
