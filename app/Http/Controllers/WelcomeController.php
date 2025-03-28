<?php

namespace App\Http\Controllers;

use App\Enums\TipoCanzone;
use App\Models\Artista;
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

    public function getLogo()
    {
        $file = "https://www.google.com/search?q=logo+sanremo+".today()->format('Y')."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[1]->src;
    }

    public function getScenografia(Request $request)
    {
        $file = "https://www.google.com/search?q=sanremo+scenografia+".$request->anno."&tbm=isch";
        $dom = HtmlDomParser::file_get_html($file);
        $elems = $dom->find('img');
        return $elems[1]->src;
    }
}
