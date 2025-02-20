<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PremiController extends Controller
{
    public function index(): View
    {
        $premi=Premio::withCount('canzoni')->get()->sortBy('anno_istituzione');
        return view('pages.premi.index', compact('premi'));
    }

    public function create(): View
    {
        return view('pages.premi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Premio::create([
            'etichetta' => $request['etichetta'],
            'colore' => $request['colore'],
            'nome' => $request['nome'],
            'wikipedia' => $request['wikipedia'],
            'anno_istituzione' => $request['anno']
        ]);

        return redirect()->route('premi.index');
    }

    public function edit(Premio $premio): View
    {
        return view('pages.premi.edit', compact('premio'));
    }


    public function update(Request $request, Premio $premio): RedirectResponse
    {
        $premio->update([
            'etichetta' => $request['etichetta'],
            'colore' => $request['colore'],
            'nome' => $request['nome'],
            'wikipedia' => $request['wikipedia'],
            'anno_istituzione' => $request['anno']
        ]);

        return redirect()->route('premi.index');
    }

    public function destroy(Premio $premio): RedirectResponse
    {
        $premio->delete();
        return redirect()->route('premi.index');
    }
}
