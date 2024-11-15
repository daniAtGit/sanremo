<?php

namespace App\Enums;

enum Social: string
{
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case X = 'x';
    case YOUTUBE = 'youtube';

    public function description() : string
    {
        return match ($this) {
            self::FACEBOOK => 'Facebook',
            self::INSTAGRAM  => 'Instagram',
            self::X  => 'X',
            self::YOUTUBE  => 'Youtube',
        };
    }

    public function icon() : string
    {
        return match ($this) {
            self::FACEBOOK => '<i class="fa-brands fa-facebook text-primary"></i>',
            self::INSTAGRAM  => '<i class="fa-brands fa-instagram text-warning"></i>',
            self::X  => '<i class="fa-brands fa-x-twitter text-info"></i>',
            self::YOUTUBE  => '<i class="fa-brands fa-youtube text-danger"></i>',
        };
    }
}
