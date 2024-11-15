<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasUuids;

    protected $table="premi";

    protected $fillable = [
        'nome',
        'descrizione',
        'anno_istituzione',
        'posizione_eurovision',
    ];

    protected $casts = [
        'anno_istituzione' => 'datetime'
    ];
}
