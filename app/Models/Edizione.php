<?php

namespace App\Models;

use App\Enums\Luogo;
use Cohensive\OEmbed\Facades\OEmbed;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edizione extends Model
{
    use HasUuids;

    protected $table="edizioni";

    protected $fillable = [
        'numero',
        'anno',
        'luogo',
        'data_da',
        'data_a',
        'note',
        'wikipedia'
    ];

    protected $casts = [
        'luogo' => Luogo::class,
        'data_da' => 'date',
        'data_a' => 'date'
    ];

    public function canzoni(): HasMany
    {
        return $this->hasMany(Canzone::class);
    }

    public function artisti(): BelongsToMany
    {
        return $this->belongsToMany(Artista::class);
    }

    public function conduttori()
    {
        return $this->artisti()->wherePivot('ruolo','conduttore')->orderBy('nome')->get();
    }

    public function coconduttori()
    {
        return $this->artisti()->wherePivot('ruolo','coconduttore')->orderBy('nome')->get();
    }

    public function ospiti()
    {
        return $this->artisti()->wherePivot('ruolo','ospite')->orderBy('nome')->get();
    }

    public function socials()
    {
        return $this->morphMany(Social::class, 'socialable');
    }

    public function scopeVincitore()
    {
        return $this->canzoni;
    }

    public function getScenografiaFromGoogle($cosa = null, $anno = null)
    {
        $file = "https://www.google.com/search?q=sanremo+".$cosa."+".$anno."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[env('INDICE_FOTO_SCENOGRAFIA',1)]->src ?? null;
    }
}
