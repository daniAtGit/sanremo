<?php

namespace App\Enums;

enum TipoCanzone: string
{
    case GARA = 'gara';
    case COVER = 'cover';
    case GIOVANI = 'giovani';

    public function description() : string
    {
        return match ($this) {
            self::GARA => 'Gara',
            self::COVER => 'Cover',
            self::GIOVANI => 'Giovani',
        };
    }

    public function icon() : string
    {
        return match ($this) {
            self::GARA => '<i class="fa fa-microphone-lines text-primary" title="Gara"></i>',
            self::COVER => '<i class="fa fa-radio text-warning" title="Cover"></i>',
            self::GIOVANI => '<i class="fa fa-music text-info" title="Giovani"></i>'
        };
    }
}
