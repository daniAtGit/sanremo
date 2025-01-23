<?php

namespace App\Enums;

enum Social: string
{
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case X = 'x';
    case YOUTUBE = 'youtube';
    case VIDEO = 'video';
    case ALTRO = 'altro';

    public function description() : string
    {
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::INSTAGRAM  => 'Instagram',
            self::X  => 'X',
            self::YOUTUBE  => 'Youtube',
            self::VIDEO  => 'Video',
            self::ALTRO  => 'Altro',
        };
    }

    public function icon() : string
    {
        return match ($this) {
            self::FACEBOOK => '<i class="fa-brands fa-facebook text-primary"></i>',
            self::INSTAGRAM  => '<i class="fa-brands fa-instagram text-warning"></i>',
            self::X  => '<i class="fa-brands fa-x-twitter text-info"></i>',
            self::YOUTUBE  => '<i class="fa-brands fa-youtube text-danger"></i>',
            self::VIDEO  => '<i class="fa fa-video"></i>',
            self::ALTRO  => '<i class="fa fa-puzzle-piece"></i>',
        };
    }
}
