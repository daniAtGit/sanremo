<?php

namespace App\Models;

use Cohensive\OEmbed\Facades\OEmbed;
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

    public function socialable()
    {
        return $this->morphTo();
    }

    public function getVideoTitle($value)
    {
        $embed = OEmbed::get($value);
        return $embed
            ? $embed->data()['title'] ?? ''
            : 'no titolo';
    }

    public function getVideo($value)
    {
        $embed = OEmbed::get($value);
        return $embed
            ? $embed->html(['width' => 350])
            : '';
    }
}
