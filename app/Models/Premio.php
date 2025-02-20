<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Premio extends Model
{
    use HasUuids;

    protected $table="premi";

    protected $fillable = [
        'etichetta',
        'colore',
        'nome',
        'wikipedia',
        'anno_istituzione'
    ];

    public function canzoni(): BelongsToMany
    {
        return $this->belongsToMany(Canzone::class);
    }

    public function assegnazioni()
    {
        return $this->canzoni()->count();
    }
}
