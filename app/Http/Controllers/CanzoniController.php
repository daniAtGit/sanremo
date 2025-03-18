<?php

namespace App\Http\Controllers;

use App\Enums\Social;
use App\Models\Artista;
use App\Models\Canzone;
use App\Models\Edizione;
use App\Models\Premio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CanzoniController extends Controller
{
    public function index(): View
    {
        $canzoni=Canzone::withCount('edizione')->get()->sortBy('titolo')->load('edizione');
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
            'tipo' => $request->tipo,
            'titolo' => $request->titolo,
            'autori' => $request->autori,
            'posizione' => $request->posizione ?? 99,
            'posizione_eurovision' => $request->posizione_euro,
            'esibizione' => $request->sanremo,
            'videoclip' => $request->videoclip,
            'eurovision' => $request->eurovision
        ]);

        $canzone->artisti()->attach($request->artisti);
        $canzone->direttori()->attach($request->direttori);
        $canzone->premi()->attach($request->premi);

        if($request->altri) {
            foreach ($request->altri as $altro) {
                if (!is_null($altro)) {
                    $canzone->socials()->create([
                        'social' => Social::ALTRO,
                        'link' => $altro
                    ]);
                }
            }
        }

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
            'tipo' => $request->tipo,
            'titolo' => $request->titolo,
            'autori' => $request->autori,
            'posizione' => $request->posizione ?? 99,
            'posizione_eurovision' => $request->posizione_euro,
            'esibizione' => $request->sanremo,
            'videoclip' => $request->videoclip,
            'eurovision' => $request->eurovision
        ]);

        $canzone->artisti()->sync($request->artisti);
        $canzone->direttori()->sync($request->direttori);
        $canzone->premi()->sync($request->premi);

        if($request->altri) {
            foreach ($request->altri as $altro) {
                if (!is_null($altro)) {
                    $canzone->socials()->create([
                        'social' => Social::ALTRO,
                        'link' => $altro
                    ]);
                }
            }
        }

        return redirect()->route('canzoni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Canzone $canzone)
    {
        $canzone->artisti()->detach();
        $canzone->premi()->detach();
        $canzone->socials()->where('social',\App\Enums\Social::ALTRO)->delete();
        $canzone->delete();
        return redirect()->route('canzoni.index');
    }

    public function deleteAltro($altro)
    {
        $social=\App\Models\Social::find($altro);
        $social->delete();
        return redirect()->back();
    }
}
