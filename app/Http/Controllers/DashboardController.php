<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Canzone;
use App\Models\Edizione;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $edizioni = Edizione::count();
        $canzoni = Canzone::count();
        $artisti = Artista::count();
        $lastEdition = Edizione::latest('numero')->first()->load('canzoni','canzoni.artisti','artisti');
        $garaTop5 = $lastEdition->canzoni->where('tipo',\App\Enums\TipoCanzone::GARA)->sortBy('posizione')->take(5);
        $coverTop5 = $lastEdition->canzoni->where('tipo',\App\Enums\TipoCanzone::COVER)->sortBy('posizione')->take(5);

        return view('dashboard', compact('edizioni','canzoni','artisti','lastEdition','garaTop5','coverTop5'));
    }
}
