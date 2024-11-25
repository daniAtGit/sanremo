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
        $request->validate([
            'nome' => 'bail|required',
            'tipo' => 'bail|required',
        ],[
            'nome.required' => 'Il campo nome è obbligatorio',
            'tipo.required' => 'Il campo tipo è obbligatorio',
        ]);

        Artista::create([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
            'nascita' => $request->input('nascita'),
            'morte' => $request->input('morte'),
            'inizio' => $request->input('inizio'),
            'fine' => $request->input('fine'),
            'wikipedia' => $request->input('wiki'),
        ]);

        return to_route('artisti.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artista $artista)
    {
        dd($artista);
    }

    public function edit(Artista $artista): View
    {
        return view('pages.artisti.edit', compact('artista'));
    }

    public function update(Request $request, Artista $artista): RedirectResponse
    {
        $request->validate([
            'nome' => 'bail|required',
            'tipo' => 'bail|required',
        ],[
            'nome.required' => 'Il campo nome è obbligatorio',
            'tipo.required' => 'Il campo tipo è obbligatorio',
        ]);

        $artista->update([
            'nome' => $request->input('nome'),
            'tipo' => $request->input('tipo'),
            'nascita' => $request->input('nascita'),
            'morte' => $request->input('morte'),
            'inizio' => $request->input('inizio'),
            'fine' => $request->input('fine'),
            'wikipedia' => $request->input('wiki'),
        ]);

        return to_route('artisti.index');
    }

    public function destroy(Artista $artista): RedirectResponse
    {
        $artista->delete();
        return to_route('artisti.index');
    }
}
