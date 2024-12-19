<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Canzone;
use App\Models\Edizione;
use App\Models\Premio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CanzoniController extends Controller
{
    public function index(): View
    {
        $canzoni=Canzone::all()->sortBy('titolo');
        return view('pages.canzoni.index', compact('canzoni'));
    }

    public function create(): View
    {
        $artisti = Artista::all()->sortBy('nome');
        $edizioni = Edizione::all()->sortByDesc('anno');
        $premi = Premio::all()->sortBy('nome');
        return view('pages.canzoni.create', compact('artisti','edizioni','premi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $canzone= Canzone::create([
            'edizione_id' => $request->edizione,
            'titolo' => $request->titolo,
            'autori' => $request->autori,
            'posizione' => $request->posizione,
            'posizione_eurovision' => $request->posizione_euro,
        ]);

        $canzone->artisti()->attach($request->artisti);
        $canzone->premi()->attach($request->premi);

        return redirect()->route('canzoni.index');
    }

    public function edit(Canzone $canzone): View
    {
        $artisti = Artista::all()->sortBy('nome');
        $edizioni = Edizione::all()->sortByDesc('anno');
        $premi = Premio::all()->sortBy('nome');
        return view('pages.canzoni.edit', compact('canzone','artisti','edizioni','premi'));
    }

    public function update(Request $request, Canzone $canzone): RedirectResponse
    {
        $canzone->update([
            'edizione_id' => $request->edizione,
            'titolo' => $request->titolo,
            'autori' => $request->autori,
            'posizione' => $request->posizione,
            'posizione_eurovision' => $request->posizione_euro,
        ]);

        $canzone->artisti()->sync($request->artisti);
        $canzone->premi()->sync($request->premi);

        return redirect()->route('canzoni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
