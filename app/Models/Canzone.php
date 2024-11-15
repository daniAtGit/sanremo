<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Canzone extends Model
{
    use HasUuids;

    protected $table="canzoni";

    protected $fillable = [
        'edizione_id',
        'titolo',
        'posizione',
        'posizione_eurovision',
    ];

    protected $casts = [
        //
    ];

    public function artista()
    {
        return $this->belongsToMany(Artista::class, 'canzone_artista');
    }
}
