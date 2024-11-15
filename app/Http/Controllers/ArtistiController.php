<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArtistiController extends Controller
{
    public function index(): View
    {
        $artisti=Artista::all()->sortBy('nome');
        return view('pages.artisti.index', compact('artisti'));
    }

    public function create(): View
    {
        return view('pages.artisti.create');
    }

    public function store(Request $request): RedirectResponse
    {
        dd($request->all());

        Artista::create([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
            'nascita' => $request->input('nascita'),
            'morte' => $request->input('morte'),
            'inizio' => $request->input('inizio'),
            'fine' => $request->input('fine'),
            'wikipedia' => $request->input('wiki'),
        ]);

        return redirect()->route('artisti.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Artista $artista): View
    {
        return view('pages.artisti.edit', compact('artista'));
    }

    public function update(Request $request, Artista $artista): RedirectResponse
    {
        $artista->update([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
            'nascita' => $request->input('nascita'),
            'morte' => $request->input('morte'),
            'inizio' => $request->input('inizio'),
            'fine' => $request->input('fine'),
            'wikipedia' => $request->input('wiki'),
        ]);

        return redirect()->route('artisti.index');
    }

    public function destroy(Artista $artista): RedirectResponse
    {
        $artista->delete();
        return redirect()->route('artisti.index');
    }
}
