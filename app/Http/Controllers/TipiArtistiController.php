<?php

namespace App\Http\Controllers;

use App\Models\TipoArtista;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TipiArtistiController extends Controller
{
    public function index(): View
    {
        $tipiArtisti=TipoArtista::withCount('artisti')->get()->sortBy('tipo')->load('artisti');
        return view('pages.tipiartisti.index', compact('tipiArtisti'));
    }

    public function store(Request $request): RedirectResponse
    {
        TipoArtista::create([
            'tipo'=>$request->tipo,
        ]);
        return redirect()->route('tipiArtisti.index');
    }

    public function update(Request $request, TipoArtista $tipoArtista): RedirectResponse
    {
        $tipoArtista->update([
            'tipo'=>$request->tipo,
        ]);
        return redirect()->route('tipiArtisti.index');
    }

    public function destroy(TipoArtista $tipoArtista): RedirectResponse
    {
        $tipoArtista->delete();
        return to_route('tipiArtisti.index');
    }
}
