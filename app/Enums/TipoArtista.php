<?php

namespace App\Enums;

enum TipoArtista: string
{
    case CANTANTE = 'cantante';
    case GRUPPO = 'gruppo';

    public function description() : string
    {
        return match ($this) {
            self::CANTANTE => 'Cantante',
            self::GRUPPO  => 'Gruppo',
        };
    }
}
