<?php

namespace App\Enums;

enum TipoArtista: string
{
    case CANTANTE = 'cantante';
    case GRUPPO = 'gruppo';
    case PRESENTATORE = 'presentatore';
    case PRESENTATRICE = 'presentatrice';
    case SHOWGIRL = 'shogirl';

    public function description() : string
    {
        return match ($this) {
            self::CANTANTE => 'Cantante',
            self::GRUPPO => 'Gruppo',
            self::PRESENTATORE => 'Presentatore',
            self::PRESENTATRICE => 'Presentatrice',
            self::SHOWGIRL => 'Show girl',
        };
    }
}
