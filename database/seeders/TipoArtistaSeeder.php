<?php

namespace Database\Seeders;

use App\Models\TipoArtista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoArtistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipi = [
            'Cantante',
            'Gruppo',
            'Presentatore',
            'Presentatrice',
            'Showman',
            'Showgirl'
        ];

        foreach($tipi as $tipo){
            TipoArtista::create([
                'tipo'     => $tipo
            ]);
        }
    }
}
