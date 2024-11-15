<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasUuids;

    protected $table="covers";

    protected $fillable = [
        'edizione_id',
        'titolo',
        'posizione',
    ];

    protected $casts = [
        //
    ];
}
