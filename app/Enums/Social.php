<?php

namespace App\Enums;

enum Social: string
{
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case X = 'x';
    case YOUTUBE = 'youtube';
    case SPOTIFY = 'spotify';
    case VIDEO = 'video';
    case ALTRO = 'altro';

    public function description() : string
    {
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::INSTAGRAM  => 'Instagram',
            self::X  => 'X',
            self::YOUTUBE  => 'Youtube',
            self::SPOTIFY  => 'Spotify',
            self::VIDEO  => 'Video',
            self::ALTRO  => 'Altro',
        };
    }

    public function icon() : string
    {
        return match ($this) {
            self::FACEBOOK => '<i class="fa-brands fa-sm fa-facebook text-primary px-1" title="'.$this->description().'"></i>',
            self::INSTAGRAM  => '<i class="fa-brands fa-sm fa-instagram text-warning px-1" title="'.$this->description().'"></i>',
            self::X  => '<i class="fa-brands fa-sm fa-x-twitter text-info px-1" title="'.$this->description().'"></i>',
            self::YOUTUBE  => '<i class="fa-brands fa-sm fa-youtube text-danger px-1" title="'.$this->description().'"></i>',
            self::SPOTIFY  => '<i class="fa-brands fa-sm fa-spotify text-success px-1" title="'.$this->description().'"></i>',
            self::VIDEO  => '<i class="fa fa-sm fa-video px-1" title="'.$this->description().'"></i>',
            self::ALTRO  => '<i class="fa fa-sm  fa-puzzle-piece px-1" title="'.$this->description().'"></i>',
        };
    }
}
