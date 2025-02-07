<?php

namespace App\Models;

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
        'nascita',
        'morte',
        'inizio',
        'fine',
        'wikipedia',
    ];

    protected $casts = [
        'nascita' => 'date',
        'morte' => 'date',
        'inizio' => 'date',
        'fine' => 'date',
    ];

    public function canzoni(): BelongsToMany
    {
        return $this->belongsToMany(Canzone::class, 'canzone_artista');
    }

    public function tipoArtista(): BelongsTo
    {
        return $this->belongsTo(\App\Models\TipoArtista::class, 'tipo_id', 'id');
    }

    public function getImgArtistaFromGoogle()
    {
        $file = "https://www.google.com/search?q=".Str::replace(" ","+",$this->nome)."+sanremo&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[1]->src ?? null;
    }
}
