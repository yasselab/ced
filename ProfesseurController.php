<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professeurs = Professeur::all();
        return view('professeurs.index', compact('professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom_complet' => 'required',
            'grade' => 'required',
            'formation_doctorale' => 'required',
            'nombre_theses' => 'required|integer',
            'encadrements' => 'required|integer',
        ]);

        Professeur::create($request->only([
            'nom_complet',
            'grade',
            'formation_doctorale',
            'nombre_theses',
            'encadrements',
        ]));

        return redirect()->route('professeurs.index')->with('success', 'Professeur créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professeur = Professeur::find($id);
        return view('professeurs.show', compact('professeur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professeur = Professeur::find($id);
        return view('professeurs.edit', compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_complet' => 'required',
            'grade' => 'required',
            'formation_doctorale' => 'required',
            'nombre_theses' => 'required|integer',
            'encadrements' => 'required|integer',
        ]);

        $professeur = Professeur::find($id);
        $professeur->update($request->all());

        return redirect()->route('professeurs.index')
                         ->with('success', 'Professeur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professeur = Professeur::find($id);
        $professeur->delete();

        return redirect()->route('professeurs.index')
                         ->with('success', 'Professeur supprimé avec succès.');
    }

}
