<?php

namespace App\Models;

use App\Enums\tipoArtista;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasUuids;

    protected $table="artisti";

    protected $fillable = [
        'nome',
        'tipo',
        'nascita',
        'morte',
        'inizio',
        'fine',
        'wikipedia',
    ];

    protected $casts = [
        'tipo' => tipoArtista::class,
        'nascita' => 'date',
        'morte' => 'date',
        'inizio' => 'date',
        'fine' => 'date',
    ];

    public function canzoni()
    {
        return $this->belongsToMany(Canzone::class, 'canzone_artista');
    }
}
