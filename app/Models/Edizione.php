<?php

namespace App\Models;

use App\Enums\Luogo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
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
        'note'
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
}
