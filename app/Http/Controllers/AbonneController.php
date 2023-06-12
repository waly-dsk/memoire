<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abonnes = DB::table('abonnes')
            ->join('options', 'abonnes.option_id', '=', 'options.id')
            ->join('entites', 'options.entite_id', '=', 'entites.id')
            ->select(
                'entites.intitule as entite',
                'options.intitule as option',
                'abonnes.id',
                'abonnes.matricule',
                'abonnes.nom',
                'abonnes.created_at'
            )
            ->orderBy('entite', 'asc')
            ->orderBy('option', 'asc')
            ->orderBy('abonnes.nom', 'asc')
            ->get();

        return view('abonne.index', [
            'user' => Auth::user(),
            'abonnes' => $abonnes,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('abonne.form', [
            'user' => Auth::user(),
            'abonne' => new Abonne(),
            'entites' => DB::table('entites')->get(),
            'options' => DB::table('options')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'matricule' => ['required', 'unique:abonnes,matricule'],
            'nom' => 'required',
            'option_id' => 'required',
        ], [
            'matricule.unique' => 'Ce matricule est déjà utilisé par un Abonné.',
            'matricule.required' => 'Le numéro matricule est obligatoire.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'option.required' => 'Vous devez choisir une option.',
        ]);

        Abonne::create($validateData);

        return back()->with('success', 'Abonné ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonne $abonne)
    {
        return view('abonne.form', [
            'user' => Auth::user(),
            'abonne' => $abonne,
            'entites' => DB::table('entites')->get(),
            'options' => DB::table('options')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Abonne $abonne)
    {
        $validateData = $request->validate([
            'matricule' => 'required',
            'nom' => 'required',
            'option_id' => 'required',
        ], [
            'matricule.required' => 'Le numéro matricule est obligatoire.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'option_id.required' => 'Vous devez choisir une option.',
        ]);
        $abonne->update($validateData);

        return back()->with('success', 'Abonné édité avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abonne $abonne)
    {
        $abonne->delete();
        return redirect()->back()->with('success', 'Abonné supprimé avec succès !');
    }
}
