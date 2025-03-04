<?php

namespace App\Http\Controllers;

use App\Enums\TipoCanzone;
use App\Models\Edizione;
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
        $videos = \App\Models\Social::where('socialable_id', $edizione->id)->get()->sortByDesc('created_at');

        $edizioni = Edizione::all();

        return view('welcome', compact('edizioni','edizione','gara','cover','giovani','videos'));
    }
}
