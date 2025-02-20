<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\TipoArtista;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArtistiController extends Controller
{
    public function index(): View
    {
        $artisti=Artista::withCount('canzoni')->withCount('edizioni')->get()->sortBy('nome')->load('tipoArtista');
        return view('pages.artisti.index', compact('artisti'));
    }

    public function create(): View
    {
        $tipiArtisti=TipoArtista::all()->sortBy('tipo');
        return view('pages.artisti.create', compact('tipiArtisti'));
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

        $artista = Artista::create([
            'nome' => $request->input('nome'),
            'tipo_id' => $request->input('tipo'),
            'wikipedia' => $request->input('wiki'),
        ]);

        foreach(\App\Enums\Social::cases() as $social)
        {
            if($request->socials[$social->value]){
                $artista->socials()->create([
                    'social' => $social,
                    'link' => $request->socials[$social->value]
                ]);
            }
        }

        return to_route('artisti.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artista $artista)
    {
        return view('pages.artisti.show', compact('artista'));
    }

    public function edit(Artista $artista): View
    {
        $artista=$artista->load('tipoArtista');
        $tipiArtisti=TipoArtista::all()->sortBy('tipo');
        return view('pages.artisti.edit', compact('artista','tipiArtisti'));
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
            'tipo_id' => $request->input('tipo'),
            'wikipedia' => $request->input('wiki'),
        ]);

        foreach(\App\Enums\Social::cases() as $social)
        {
            if($request->socials[$social->value]){
                $artista->socials()->updateOrCreate([
                    'social' => $social
                ],[
                    'link' => $request->socials[$social->value]
                ]);
            }
        }

        return to_route('artisti.index');
    }

    public function destroy(Artista $artista): RedirectResponse
    {
        $artista->socials()->delete();
        $artista->delete();
        return to_route('artisti.index');
    }
}
