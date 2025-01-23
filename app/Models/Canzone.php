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
        'scrittori',
        'posizione',
        'posizione_eurovision',
        'esibizione',
        'videoclip',
        'eurovision'
    ];

    protected $casts = [
        //
    ];

    public function edizione()
    {
        return $this->belongsTo(Edizione::class);
    }

    public function artisti()
    {
        return $this->belongsToMany(Artista::class, 'canzone_artista');
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
}
