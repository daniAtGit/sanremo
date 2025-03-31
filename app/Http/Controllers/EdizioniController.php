<?php

namespace App\Http\Controllers;

use App\Enums\Social;
use App\Models\Artista;
use App\Models\Edizione;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EdizioniController extends Controller
{
    public function index(): View
    {
        $edizioni=Edizione::all()->sortByDesc('anno');
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
            'wikipedia' => $request->wiki
        ]);

        $edizione->artisti()->attach($request->conduttori, ['ruolo' => 'conduttore']);
        $edizione->artisti()->attach($request->coconduttori, ['ruolo' => 'coconduttore']);
        $edizione->artisti()->attach($request->ospiti, ['ruolo' => 'ospite']);

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
        $edizione->load('artisti','socials');
        $videos = \App\Models\Social::where('socialable_id', $edizione->id)->get()->sortByDesc('created_at');
        return view('pages.edizioni.show', compact('edizione','videos'));
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
            'wikipedia' => $request->wiki
        ]);

        $artisti_array=[];
        if(!is_null($request->conduttori)) {
            foreach($request->conduttori as $conduttore) {$artisti_array[$conduttore] = ['ruolo' => 'conduttore'];}
        }

        if(!is_null($request->coconduttori)) {
            foreach ($request->coconduttori as $coconduttore) {$artisti_array[$coconduttore] = ['ruolo' => 'coconduttore'];}
        }

        if(!is_null($request->ospiti)) {
            foreach ($request->ospiti as $ospite) {$artisti_array[$ospite] = ['ruolo' => 'ospite'];}
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

    public function getVideo(Request $request)
    {
        $videos = \App\Models\Social::where('socialable_id', $request->edizione_id)->get()->sortByDesc('created_at');

        $allVideo = [];
        foreach ($videos as $video) {
            $tipo = 'video';
            $title = $video->getVideoTitle($video->link);
            $url = $video->getVideo($video->link);

            if(empty($url)){
                $tipo = 'link';
                $title = $video->link;
                $url = $video->link;
            }

            $allVideo[] = [
                'title' => $title,
                'url' => $url,
                'tipo' => $tipo
            ];
        }

        return $allVideo;
    }
}
