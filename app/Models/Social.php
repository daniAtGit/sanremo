<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasUuids;

    protected $table="socials";

    protected $fillable = [
        'socialable_type',
        'socialable_id',
        'social',
        'link',
    ];

    protected $casts = [
        'social' => \App\Enums\Social::class,
    ];
}
