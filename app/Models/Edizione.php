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
        'note',
    ];

    protected $casts = [
        'luogo' => Luogo::class,
    ];

    public function canzoni(): HasMany
    {
        return $this->hasMany(Canzone::class);
    }
}
