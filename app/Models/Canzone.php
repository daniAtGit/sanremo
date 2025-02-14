<?php

namespace App\Models;

use App\Enums\TipoCanzone;
use Cohensive\OEmbed\Facades\OEmbed;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Canzone extends Model
{
    use HasUuids;

    protected $table="canzoni";

    protected $fillable = [
        'edizione_id',
        'tipo',
        'titolo',
        'posizione',
        'posizione_eurovision',
        'esibizione',
        'videoclip',
        'eurovision'
    ];

    protected $casts = [
        'tipo' => TipoCanzone::class
    ];

    public function edizione()
    {
        return $this->belongsTo(Edizione::class);
    }

    public function artisti()
    {
        return $this->belongsToMany(Artista::class, 'canzone_artista');
    }

    public function autori()
    {
        return $this->belongsToMany(Artista::class, 'canzone_autore');
    }

    public function direttori()
    {
        return $this->belongsToMany(Artista::class, 'canzone_direttore');
    }

    public function premi()
    {
        return $this->belongsToMany(Premio::class, 'canzone_premio');
    }

    public function socials()
    {
        return $this->morphMany(Social::class, 'socialable');
    }

    public function scopeAltri()
    {
        return $this->socials();
    }

    public function getVideoTitle($value)
    {
        $embed = OEmbed::get($value);
        return $embed->data()['title'] ?? '';
    }

    public function getVideoSmall($value)
    {
        $embed = OEmbed::get($value);
        return $embed->html(['width' => 70]);
    }

    public function getVideo($value)
    {
        $embed = OEmbed::get($value);
        return $embed->html(['width' => 350]);
    }
}
