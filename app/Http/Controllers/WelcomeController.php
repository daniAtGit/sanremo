<?php

namespace App\Http\Controllers;

use App\Enums\TipoCanzone;
use App\Models\Artista;
use App\Models\Canzone;
use App\Models\Edizione;
use App\Models\Social;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if($request->edizione){
            $edizione = Edizione::find($request->edizione)->load('canzoni','canzoni.artisti','artisti');
        }else{
            $edizione = Edizione::latest('numero')->first()->load('canzoni','canzoni.artisti','artisti');
        }

        $gara = $edizione->canzoni->where('tipo',TipoCanzone::GARA)->sortBy('posizione');
        $cover = $edizione->canzoni->where('tipo',TipoCanzone::COVER)->sortBy('posizione');
        $giovani = $edizione->canzoni->where('tipo',TipoCanzone::GIOVANI)->sortBy('posizione');
        $videos = Social::where('socialable_id', $edizione->id)->get()->sortByDesc('created_at');

        $edizioni = Edizione::all();

        return view('welcome.index', compact('edizioni','edizione','gara','cover','giovani','videos'));
    }

    public function cerca(Request $request)
    {
        $artisti = Artista::where('nome', 'like', '%'.$request->stringa.'%')->get();
        $canzoni = Canzone::where('titolo', 'like', '%'.$request->stringa.'%')->get();
        $edizioniS = Edizione::where('anno', 'like', '%'.$request->stringa.'%')->orWhere('note', 'like', '%'.$request->stringa.'%')->get();
        $edizioni = Edizione::all();
        return view('welcome.cerca', compact('artisti','canzoni','edizioniS','edizioni'));
    }

    public function getLogo()
    {
        $file = "https://www.google.com/search?q=logo+sanremo+".today()->format('Y')."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[env('INDICE_LOGO',1)]->src;
    }

    public function getScenografia(Request $request)
    {
        $file = "https://www.google.com/search?q=sanremo+scenografia+".$request->anno."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[env('INDICE_FOTO_SCENOGRAFIA',1)]->src;
    }

    public function getVideos(Request $request)
    {
        $videos = Social::where('socialable_id', $request->edizione_id)->get()->sortByDesc('created_at');

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

    public function artistaShow($id)
    {
        $artista = Artista::find($id)->load('canzoni','canzoni.edizione','canzoni.edizione.artisti');

        $conduzioni = $artista->edizioni->where('pivot.ruolo','conduttore');
        $coconduzioni = $artista->edizioni->where('pivot.ruolo','coconduttore');
        $ospitate = $artista->edizioni->where('pivot.ruolo','ospite');

        $gare = $artista->canzoni->where('tipo',TipoCanzone::GARA);
        $covers = $artista->canzoni->where('tipo',TipoCanzone::COVER);
        $euro = $artista->canzoni->where('tipo',TipoCanzone::GARA)->whereNotNull('posizione_eurovision');

        $eventi=[];

        foreach($conduzioni as $conduzione){
            $eventi[] = [
                'indice' => 0,
                'anno' => $conduzione->anno,
                'ruolo' => 'Conduttore',
                'titolo' => '',
                'edizione' => $conduzione->numero,
                'edizione_id' => $conduzione->id,
                'pos' => null,
                'spotify' => null,
                'esibizione' => null,
                'videoclip' => null,
                'altro' => []
            ];
        }

        foreach($coconduzioni as $coconduzione){
            $eventi[] = [
                'indice' => 0,
                'anno' => $coconduzione->anno,
                'ruolo' => 'Coconduttore',
                'titolo' => '',
                'edizione' => $coconduzione->numero,
                'edizione_id' => $coconduzione->id,
                'pos' => null,
                'spotify' => null,
                'esibizione' => null,
                'videoclip' => null,
                'altro' => []
            ];
        }

        foreach($ospitate as $ospitata){
            $eventi[] = [
                'indice' => 0,
                'anno' => $ospitata->anno,
                'ruolo' => 'Ospite',
                'titolo' => '',
                'edizione' => $ospitata->numero,
                'edizione_id' => $ospitata->id,
                'pos' => null,
                'spotify' => null,
                'esibizione' => null,
                'videoclip' => null,
                'altro' => []
            ];
        }

        foreach($gare as $gara){
            $altro=[];

            foreach($gara->socials->where('social',\App\Enums\Social::ALTRO) as $alt){
                $altro[] = $alt;
            }

            $eventi[] = [
                'indice' => 1,
                'anno' => $gara->edizione?->anno,
                'ruolo' => 'Gara',
                'titolo' => '- '.$gara->titolo,
                'edizione' => $gara->edizione->numero,
                'edizione_id' => $gara->edizione->id,
                'pos' => $gara->posizione,
                'spotify' => $gara->spotify,
                'esibizione' => $gara->esibizione,
                'videoclip' => $gara->videoclip,
                'altro' => $altro
            ];
        }

        foreach($covers as $cover){
            $altro=[];

            foreach($cover->socials->where('social',\App\Enums\Social::ALTRO) as $alt){
                $altro[] = $alt;
            }

            $eventi[] = [
                'indice' => 2,
                'anno' => $cover->edizione?->anno,
                'ruolo' => 'Cover',
                'titolo' => '- '.$cover->titolo,
                'edizione' => $cover->edizione->numero,
                'edizione_id' => $cover->edizione->id,
                'pos' => $cover->posizione,
                'spotify' => $cover->spotify,
                'esibizione' => $cover->esibizione,
                'videoclip' => $cover->videoclip,
                'altro' => $altro
            ];
        }

        foreach($euro as $e){
            $eventi[] = [
                'indice' => 3,
                'anno' => $e->edizione?->anno,
                'ruolo' => 'Eurovision',
                'titolo' => '- '.$e->titolo,
                'edizione' => $e->edizione->numero,
                'edizione_id' => $e->edizione->id,
                'pos' => $e->posizione_eurovision,
                'spotify' => null,
                'esibizione' => $e->eurovision,
                'videoclip' => null,
                'altro' => []
            ];
        }

        usort($eventi, function($a, $b) {
            return $b['anno'] <=> $a['anno'] ?: $a['indice'] <=> $b['indice'];
        });

        return view('welcome.artista', compact('artista','eventi'));
    }
}
