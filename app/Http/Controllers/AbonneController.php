<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAbonneRequest;
use App\Models\Abonne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchAbonneRequest $request)
    {
        $abonnes = DB::table('abonnes')
            ->join('type_abonnes', 'abonnes.type_abonne_id', '=', 'type_abonnes.id')
            ->join('entites', 'abonnes.entite_id', '=', 'entites.id')
            ->select(
                'entites.intitule as entite',
                'abonnes.id',
                'type_abonnes.nom as type_abonne',
                'abonnes.matricule',
                'abonnes.nom',
                'abonnes.created_at'
            )
            ->orderBy('entite', 'asc')
            ->orderBy('type_abonne', 'asc')
            ->orderBy('abonnes.nom', 'asc')
            ->get();

        if ($entite = $request->validated('entite')) {
            $abonnes = DB::table('abonnes')
                ->join('type_abonnes', 'abonnes.type_abonne_id', '=', 'type_abonnes.id')

                ->join('entites', 'abonnes.entite_id', '=', 'entites.id')
                ->where('entites.intitule', '=', $entite)
                ->select(
                    'entites.intitule as entite',
                    'abonnes.id',
                    'abonnes.matricule',
                    'type_abonnes.nom as type_abonne',
                    'abonnes.nom',
                    'abonnes.created_at'
                )
                ->orderBy('entite', 'asc')
                ->orderBy('type_abonne', 'asc')
                ->orderBy('abonnes.nom', 'asc')
                ->get();
        }

        if ($type_abonne = $request->validated('type_abonne')) {
            $abonnes = DB::table('abonnes')
                ->join('type_abonnes', 'abonnes.type_abonne_id', '=', 'type_abonnes.id')
                ->join('entites', 'abonnes.entite_id', '=', 'entites.id')
                ->where('type_abonnes.id', '=', $type_abonne)
                ->select(
                    'entites.intitule as entite',
                    'abonnes.id',
                    'type_abonnes.nom as type_abonne',
                    'abonnes.matricule',
                    'abonnes.nom',
                    'abonnes.created_at'
                )
                ->orderBy('entite', 'asc')
                ->orderBy('type_abonne', 'asc')
                ->orderBy('abonnes.nom', 'asc')
                ->get();
        }



        if ($matricule = $request->validated('matricule')) {
            $abonnes = DB::table('abonnes')
                ->join('type_abonnes', 'abonnes.type_abonne_id', '=', 'type_abonnes.id')
                ->join('entites', 'abonnes.entite_id', '=', 'entites.id')
                ->where('abonnes.matricule', '=', $matricule)
                ->select(
                    'entites.intitule as entite',
                    'type_abonnes.nom as type_abonne',
                    'abonnes.id',
                    'abonnes.matricule',
                    'abonnes.nom',
                    'abonnes.created_at'
                )
                ->orderBy('entite', 'asc')
                ->orderBy('type_abonne', 'asc')
                ->orderBy('abonnes.nom', 'asc')
                ->get();
        }



        if ($nom = $request->validated('nom')) {
            $abonnes = DB::table('abonnes')
                ->join('type_abonnes', 'abonnes.type_abonne_id', '=', 'type_abonnes.id')
                ->join('entites', 'abonnes.entite_id', '=', 'entites.id')
                ->where('abonnes.nom', 'like', '%' . $nom . '%')
                ->select(
                    'entites.intitule as entite',
                    'type_abonnes.nom as type_abonne',
                    'abonnes.id',
                    'abonnes.matricule',
                    'abonnes.nom',
                    'abonnes.created_at'
                )
                ->orderBy('entite', 'asc')
                ->orderBy('type_abonne', 'asc')
                ->orderBy('abonnes.nom', 'asc')
                ->get();
        }


        return view('abonne.index', [
            'user' => Auth::user(),
            'abonnes' => $abonnes,
            'type_abonnes' => DB::table('type_abonnes')->get(),
            'input' => $request->validated(),
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
            'type_abonnes' => DB::table('type_abonnes')->get(),
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
            'type_abonne_id' => 'required',
            'matricule' => 'required|unique:abonnes,matricule',
            'nom' => 'required',
            'entite_id' => 'required',
        ], [
            'type_abonne_id.required' => 'Veuillez choisir un type d\'abonné.',
            'matricule.required' => 'Le numéro matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule est déjà utilisé par un Abonné.',
            'nom.required' => 'Le champ nom est obligatoire.',
            'entite.required' => 'Vous devez choisir une entité.',
        ]);

        $validateData['nom'] = $request->input('nom');
        $validateData['matricule'] = $request->input('matricule');
        $validateData['entite_id'] = $request->input('entite_id');
        $validateData['type_abonne_id'] = $request->input('type_abonne_id');

        Abonne::create($validateData);

        return to_route('abonne.index')->with('success', 'Abonné ajouté avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonne $abonne)
    {
        return view('abonne.form', [
            'user' => Auth::user(),
            'abonne' => $abonne,
            'type_abonnes' => DB::table('type_abonnes')->get(),
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
            'type_abonne_id' => 'required',
            'entite_id' => 'required',
            'matricule' => 'required',
            'nom' => 'required',
        ], [
            'type_abonne_id.required' => 'Le type d\'abonné est obligatoire.',
            'entite_id.required' => 'Vous devez choisir une entité.',
            'matricule.required' => 'Le numéro matricule est obligatoire.',
            'nom.required' => 'Le champ nom est obligatoire.',
        ]);

        $abonne->update($validateData);

        return to_route('abonne.index')->with('success', 'Abonné édité avec succès');
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
