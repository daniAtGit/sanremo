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
        $premi=Premio::all()->sortBy('anno_istituzione');
        return view('pages.premi.index', compact('premi'));
    }

    public function create(): View
    {
        return view('pages.premi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Premio::create([
            'nome' => $request['nome'],
            'descrizione' => $request['descrizione'],
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
            'nome' => $request['nome'],
            'descrizione' => $request['descrizione'],
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
