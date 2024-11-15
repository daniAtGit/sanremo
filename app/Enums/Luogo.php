<?php

namespace App\Enums;

enum Luogo: string
{
    case ARISTON = 'ariston';
    case CASINO = 'casino';

    public function description() : string
    {
        return match ($this) {
            self::ARISTON => 'Teatro Ariston',
            self::CASINO  => 'Casinò'
        };
    }
}
