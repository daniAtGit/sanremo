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

        return view('dashboard', compact('edizioni','canzoni','artisti','lastEdition'));
    }
}
