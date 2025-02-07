<?php

namespace App\Http\Controllers;

use App\Enums\Social;
use App\Models\Artista;
use App\Models\Edizione;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;

class EdizioniController extends Controller
{
    public function index(): View
    {
        $edizioni=Edizione::all()->sortByDesc('anno');
        //$edizioni->load('canzoni','canzoni.artisti','canzoni.premi','canzoni.artisti.socials','covers','ospiti');
        return view('pages.edizioni.index', compact('edizioni'));
    }

    public function create(): View
    {
        $artisti=Artista::all()->sortBy('nome');
        return view('pages.edizioni.create', compact('artisti'));
    }

    public function store(Request $request): RedirectResponse
    {
        $edizione=Edizione::create([
            'numero' => $request->numero,
            'anno' => $request->anno,
            'data_da' => $request->data_da,
            'data_a' => $request->data_a,
            'luogo' => $request->luogo,
            'note' => $request->note,
        ]);

        $edizione->artisti()->attach($request->conduttori, ['ruolo' => 'conduttore']);
        $edizione->artisti()->attach($request->coconduttori, ['ruolo' => 'coconduttore']);

        if($request->altri) {
            foreach ($request->altri as $altro) {
                if (!is_null($altro)) {
                    $edizione->socials()->create([
                        'social' => Social::ALTRO,
                        'link' => $altro
                    ]);
                }
            }
        }

        return to_route('edizioni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Edizione $edizione)
    {
        return view('pages.edizioni.show', compact('edizione'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edizione $edizione)
    {
        $artisti=Artista::all()->sortBy('nome');
        return view('pages.edizioni.edit', compact('edizione','artisti'));
    }

    public function update(Request $request, Edizione $edizione): RedirectResponse
    {
        $edizione->update([
            'numero' => $request->numero,
            'anno' => $request->anno,
            'data_da' => $request->data_da,
            'data_a' => $request->data_a,
            'luogo' => $request->luogo,
            'note' => $request->note,
        ]);

        $artisti_array=[];
        if(!is_null($request->conduttori)) {
            foreach($request->conduttori as $conduttore) {$artisti_array[$conduttore] = ['ruolo' => 'conduttore'];}
        }

        if(!is_null($request->coconduttori)) {
            foreach ($request->coconduttori as $coconduttore) {$artisti_array[$coconduttore] = ['ruolo' => 'coconduttore'];}
        }

        if($request->altri) {
            foreach ($request->altri as $altro) {
                if (!is_null($altro)) {
                    $edizione->socials()->create([
                        'social' => Social::ALTRO,
                        'link' => $altro
                    ]);
                }
            }
        }

        $edizione->artisti()->sync($artisti_array);
        return to_route('edizioni.index');
    }

    public function destroy(Edizione $edizione): RedirectResponse
    {
        $edizione->delete();
        return to_route('edizioni.index');
    }

    public function deleteAltro($altro)
    {
        $social=\App\Models\Social::find($altro);
        $social->delete();
        return redirect()->back();
    }
}
