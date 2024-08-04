<?php

namespace App\Http\Controllers;

use App\Models\EtudiantInscrit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EtudiantInscritController extends Controller
{
    public function index()
    {
        $etudiants = EtudiantInscrit::all();
        return view('etudiants_inscrits.index', compact('etudiants'));
    }

    public function create()
    {
        return view('etudiants_inscrits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'num_ins_condida' => 'required',
            'nom_fr' => 'required',
            'nom_ar' => 'required',
            'prenom_fr' => 'required',
            'prenom_ar' => 'required',
            'date_nai' => 'required|date',
            'email' => 'required|email',
            'cin' => 'required',
            'appogee' => 'required',
            'sexe' => 'required',
            'lieu_nai_fr' => 'required',
            'lieu_nai_ar' => 'required',
            'tele_1' => 'required',
            'tele_2' => 'nullable',
            'address_fr' => 'required',
            'address_ar' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'handicapé' => 'nullable',
            'profession' => 'required',
            'password' => 'required',
            'num_dossier' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $request->merge(['image' => $imagePath]);
        }

        // Store the data
        $etudiantInscrit = EtudiantInscrit::create($request->all());

        // Generate the PDF
        $pdf = Pdf::loadView('pdf.etudiant_inscrit', ['etudiant' => $etudiantInscrit]);
        $pdfPath = 'pdfs/etudiant_inscrit_' . $etudiantInscrit->id . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        return redirect()->route('etudiants_inscrits.create')
            ->with('success', 'Étudiant inscrit ajouté avec succès.')
            ->with('pdf_path', $pdfPath);
    }

    public function show(EtudiantInscrit $etudiantInscrit)
    {
        return view('etudiants_inscrits.show', compact('etudiantInscrit'));
    }

    public function edit(EtudiantInscrit $etudiantInscrit)
    {
        return view('etudiants_inscrits.edit', compact('etudiantInscrit'));
    }

    public function update(Request $request, EtudiantInscrit $etudiantInscrit)
    {
        $request->validate([
            'num_ins_condida' => 'required',
            'nom_fr' => 'required',
            'nom_ar' => 'required',
            'prenom_fr' => 'required',
            'prenom_ar' => 'required',
            'date_nai' => 'required|date',
            'email' => 'required|email',
            'cin' => 'required',
            'appogee' => 'required',
            'sexe' => 'required',
            'lieu_nai_fr' => 'required',
            'lieu_nai_ar' => 'required',
            'tele_1' => 'required',
            'tele_2' => 'nullable',
            'address_fr' => 'required',
            'address_ar' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'handicapé' => 'nullable',
            'profession' => 'required',
            'password' => 'required',
            'num_dossier' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $request->merge(['image' => $imagePath]);
        }

        $etudiantInscrit->update($request->all());

        return redirect()->route('etudiants_inscrits.index')
            ->with('success', 'Étudiant inscrit mis à jour avec succès.');
    }

    public function destroy(EtudiantInscrit $etudiantInscrit)
    {
        $etudiantInscrit->delete();

        return redirect()->route('etudiants_inscrits.index')
            ->with('success', 'Étudiant inscrit supprimé avec succès.');
    }
}
