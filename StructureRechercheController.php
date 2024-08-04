<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StructureRecherche;

class StructureRechercheController extends Controller
{
    public function index()
    {
        $structuresRecherche = StructureRecherche::all();
        return view('structure_recherche.index', compact('structuresRecherche'));
    }

    public function create()
    {
        return view('structure_recherche.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_structure' => 'required',
            'responsable' => 'required',
            'type' => 'required',
            'discipline' => 'required',
            'description' => 'nullable',
        ]);

        StructureRecherche::create($request->all());

        return redirect()->route('structure_recherche.index')->with('success', 'Structure de recherche créée avec succès.');
    }

    public function show($id)
    {
        $structureRecherche = StructureRecherche::findOrFail($id);
        return view('structure_recherche.show', compact('structureRecherche'));
    }

    public function edit($id)
    {
        $structureRecherche = StructureRecherche::findOrFail($id);
        return view('structure_recherche.edit', compact('structureRecherche'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_structure' => 'required',
            'responsable' => 'required',
            'type' => 'required',
            'discipline' => 'required',
            'description' => 'nullable',
        ]);

        $structureRecherche = StructureRecherche::findOrFail($id);
        $structureRecherche->update($request->all());

        return redirect()->route('structure_recherche.index')->with('success', 'Structure de recherche mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $structureRecherche = StructureRecherche::findOrFail($id);
        $structureRecherche->delete();

        return redirect()->route('structure_recherche.index')->with('success', 'Structure de recherche supprimée avec succès.');
    }
}
