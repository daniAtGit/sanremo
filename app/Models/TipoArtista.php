<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoArtista extends Model
{
    use HasUuids;

    protected $table="tipo-artista";

    protected $fillable = [
        'tipo'
    ];

    protected $casts = [
        //
    ];

    public function artisti(): HasMany
    {
        return $this->hasMany(Artista::class, 'tipo_id', 'id');
    }
}
