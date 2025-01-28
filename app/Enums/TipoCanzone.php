<?php

namespace App\Enums;

enum TipoCanzone: string
{
    case GARA = 'gara';
    case COVER = 'cover';

    public function description() : string
    {
        return match ($this) {
            self::GARA => 'Gara',
            self::COVER => 'Cover',
        };
    }

    public function icon() : string
    {
        return match ($this) {
            self::GARA => '<i class="fa fa-music text-primary" title="Gara"></i>',
            self::COVER => '<i class="fa fa-radio text-warning" title="Cover">',
        };
    }
}
