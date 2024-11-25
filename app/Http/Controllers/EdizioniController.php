<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Canzone;
use App\Models\Edizione;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EdizioniController extends Controller
{
    public function index(): View
    {
        $edizioni=Edizione::all()->sortByDesc('anno')->load('conduttori','cococonduttori','canzoni','canzoni.artisti','canzoni.premi','canzoni.artisti.socials','covers','ospiti');
        return view('pages.edizioni.index', compact('edizioni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artisti=Artista::all()->sortByDesc('nome');
        return view('pages.edizioni.create', compact('artisti'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Edizione::create([
            'numero' => $request->numero,
            'anno' => $request->anno,
            'data_da' => $request->data_da,
            'data_a' => $request->data_a,
            'luogo' => $request->luogo,
            'note' => $request->note,
        ]);

        return to_route('edizioni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
