<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistaEdizione extends Model
{
    protected $table="artista_edizione";

    protected $fillable = [
        'artista_id',
        'edizione_id',
        'ruolo'
    ];
}
