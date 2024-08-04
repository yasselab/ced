<?php

namespace App\Http\Controllers;

use App\Models\Sujet;
use Illuminate\Http\Request;

class SujetController extends Controller
{
    public function index()
    {
        $sujets = Sujet::all();
        return view('sujets.index', compact('sujets'));
    }

    public function create()
    {
        return view('sujets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'acronyme' => 'required|string|max:10',
            'anne_propos' => 'required|integer',
        ]);

        Sujet::create($request->all());

        return redirect()->route('sujets.index')
                         ->with('success', 'Sujet créé avec succès.');
    }

    public function show(Sujet $sujet)
    {
        return view('sujets.show', compact('sujet'));
    }

    public function edit(Sujet $sujet)
    {
        return view('sujets.edit', compact('sujet'));
    }

    public function update(Request $request, Sujet $sujet)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'acronyme' => 'required|string|max:10',
            'anne_propos' => 'required|integer',
        ]);

        $sujet->update($request->all());

        return redirect()->route('sujets.index')
                         ->with('success', 'Sujet mis à jour avec succès.');
    }

    public function destroy(Sujet $sujet)
    {
        $sujet->delete();
        return redirect()->route('sujets.index')
                         ->with('success', 'Sujet supprimé avec succès.');
    }
}

