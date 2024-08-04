<?php

namespace App\Http\Controllers;

use App\Models\EtudiantAdmi;
use Illuminate\Http\Request;

class EtudiantAdmiController extends Controller
{
    public function index()
    {
        $etudiants = EtudiantAdmi::all();
        return view('etudiants_admis.index', compact('etudiants'));
    }

    public function create()
    {
        return view('etudiants_admis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required',
            'cin' => 'required|unique:etudiants_admis',
            'cne' => 'required|unique:etudiants_admis',
            'encadrant' => 'required',
            'sujet' => 'required',
        ]);

        EtudiantAdmi::create($request->all());

        return redirect()->route('etudiants_admis.index')
            ->with('success', 'Étudiant admis ajouté avec succès.');
    }

    public function show(EtudiantAdmi $etudiantAdmi)
    {
        return view('etudiants_admis.show', compact('etudiantAdmi'));
    }

    public function edit(EtudiantAdmi $etudiantAdmi)
    {

        return view('etudiants_admis.edit', compact('etudiantAdmi'));
    }

    public function update(Request $request, EtudiantAdmi $etudiantAdmi)
    {
        $request->validate([
            'nom_complet' => 'required',
            'cin' => 'required|unique:etudiants_admis,cin,' . $etudiantAdmi->id,
            'cne' => 'required|unique:etudiants_admis,cne,' . $etudiantAdmi->id,
            'encadrant' => 'required',
            'sujet' => 'required',
        ]);

        $etudiantAdmi->update($request->all());

        return redirect()->route('etudiants_admis.index')
            ->with('success', 'Étudiant admis mis à jour avec succès.');
    }

    public function destroy(EtudiantAdmi $etudiantAdmi)
    {
        $etudiantAdmi->delete();

        return redirect()->route('etudiants_admis.index')
            ->with('success', 'Étudiant admis supprimé avec succès.');
    }
}


