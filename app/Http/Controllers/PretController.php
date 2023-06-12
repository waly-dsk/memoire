<?php

namespace App\Http\Controllers;

use App\Models\Pret;
use App\Models\Abonne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prets = DB::table('prets')
            ->join('abonnes', 'prets.abonne_id', '=', 'abonnes.id')
            ->join('users', 'prets.user_id', '=', 'users.id')
            ->select(
                'prets.id as pret_id',
                'prets.date_debut',
                'prets.date_fin_prevue',
                'abonnes.nom',
                'users.name as agent',
            )
            ->paginate(2);

        return view('prets.index', [
            'user' => Auth::user(),
            'prets' => $prets,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $abonnes = Abonne::all();
        $livre_imprimes = DB::table('livre_imprimes')
            ->join('livre_imprime_exemplaires', 'livre_imprime_exemplaires.livre_imprime_id', '=', 'livre_imprimes.id')
            ->where('livre_imprime_exemplaires.statut', '=', 0)
            ->select('livre_imprimes.titre', 'livre_imprime_exemplaires.id')
            ->get();

        return view('prets.form', [
            'user' => $user,
            'abonnes' => $abonnes,
            'livre_imprimes' => $livre_imprimes,
            'pret' => new Pret(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'abonne_id' => ['required'],
            'livre_imprime_exemplaire_id' => ['required', 'array'],
            'date_debut' => ['required'],
            'date_fin_prevue' => ['required'],
        ], [
            'abonne_id.required' => 'Le champ Abonné est requis.',
            'livre_imprime_exemplaire_id.required' => 'Choisissez au moins un ouvrage.',
            'livre_imprime_exemplaire_id.array' => 'Le champ livre_imprime_exemplaire_id doit être un tableau.',
            'date_debut.required' => 'Renseignez la date de début.',
            'date_fin_prevue.required' => 'Renseignez la date de fin prévue.',
        ]);

        $pret = new Pret();
        $pret->user_id = Auth::user()->id;
        $pret->abonne_id = $validateData['abonne_id'];
        $pret->date_debut = $validateData['date_debut'];
        $pret->date_fin_prevue = $validateData['date_fin_prevue'];

        $pret->save();

        $pret_id = $pret->id;

        $taille = sizeof($validateData['livre_imprime_exemplaire_id']);

        for ($i = 0; $i < $taille; $i++) {
            DB::table('exemplaire_pretes')->insert([
                'pret_id' => $pret_id,
                'livre_imprime_exemplaire_id' => $validateData['livre_imprime_exemplaire_id'][$i],
            ]);

            DB::table('livre_imprime_exemplaires')
                ->where('id', '=', $validateData['livre_imprime_exemplaire_id'][$i])
                ->update([
                    'statut' => 1,
                ]);
        }

        return to_route('pret.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pret = DB::table('prets')
            ->where('prets.id', '=', $id)
            ->join('users', 'users.id', '=', 'prets.user_id')
            ->join('abonnes', 'abonnes.id', '=', 'prets.abonne_id')
            ->first();

        $details = DB::table('prets')
            ->join('exemplaire_pretes', 'exemplaire_pretes.pret_id', '=', 'prets.id')
            ->join('livre_imprime_exemplaires', 'exemplaire_pretes.livre_imprime_exemplaire_id', '=', 'livre_imprime_exemplaires.id')
            ->join('livre_imprimes', 'livre_imprime_exemplaires.livre_imprime_id', '=', 'livre_imprimes.id')
            ->where('prets.id', '=', $id)
            ->select('livre_imprimes.titre', DB::raw('COUNT(livre_imprime_exemplaires.livre_imprime_id) as total'))
            ->groupBy('livre_imprime_id')
            ->get();

        return view('prets.show', [
            'user' => Auth::user(),
            'pret' => $pret,
            'details' => $details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $abonnes = Abonne::all();
        $livre_imprimes = DB::table('livre_imprimes')
            ->join('livre_imprime_exemplaires', 'livre_imprime_exemplaires.livre_imprime_id', '=', 'livre_imprimes.id')
            ->where('livre_imprime_exemplaires.statut', '=', 0)
            ->select('livre_imprimes.titre', 'livre_imprime_exemplaires.id')
            ->get();

        return view('prets.form', [
            'user' => $user,
            'abonnes' => $abonnes,
            'livre_imprimes' => $livre_imprimes,
            'pret' => new Pret(),
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pret $pret)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pret $pret)
    {
        //
    }
}
