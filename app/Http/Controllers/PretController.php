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
     * Pour sélectionner uniquement les prêts contenant encore des
     * ouvrages non retournés, vous pouvez utiliser une sous-requête
     * pour filtrer les prêts en fonction de leur statut dans la table
     * exemplaire_pretes. Voici la requête améliorée :
     */
    public function index()
    {
        $prets = DB::table('prets')
            ->join('abonnes', 'prets.abonne_id', '=', 'abonnes.id')
            ->join('users', 'prets.user_id', '=', 'users.id')
            ->whereIn('prets.id', function ($query) {
                $query->select('pret_id')
                    ->from('exemplaire_pretes')
                    ->where('retourne', '=', false);
            })
            ->select(
                'prets.id as pret_id',
                'prets.date_debut',
                'prets.date_fin_prevue',
                'abonnes.nom',
                'users.name as agent',
            )
            ->get();
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
            ->where('exemplaire_pretes.retourne', '=', false) // Ajouter cette condition
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

        $informations_pret = DB::table('prets')
            ->where('prets.id', '=', $id)
            ->join('users', 'users.id', '=', 'prets.user_id')
            ->join('abonnes', 'abonnes.id', '=', 'prets.abonne_id')
            ->first();

        $mes_prets = DB::table('prets')
            ->join('exemplaire_pretes', 'prets.id', '=', 'exemplaire_pretes.pret_id')
            ->join('livre_imprime_exemplaires', 'exemplaire_pretes.livre_imprime_exemplaire_id', '=', 'livre_imprime_exemplaires.id')
            ->where('exemplaire_pretes.pret_id', '=', $id)
            ->select('livre_imprime_exemplaires.id as exemplaire_id')
            ->get();

        foreach ($mes_prets as $pret) {

            DB::table('exemplaire_pretes')
                ->where('livre_imprime_exemplaire_id', '=', $pret->exemplaire_id)
                ->delete();

            DB::table('livre_imprime_exemplaires')
                ->where('id', '=', $pret->exemplaire_id)
                ->where('statut', '=', 1)
                ->update([
                    'statut' => 0,
                ]);
        }

        $livre_imprimes = DB::table('livre_imprimes')
            ->join('livre_imprime_exemplaires', 'livre_imprime_exemplaires.livre_imprime_id', '=', 'livre_imprimes.id')
            ->where('livre_imprime_exemplaires.statut', '=', 0)
            ->select('livre_imprimes.titre', 'livre_imprime_exemplaires.id')
            ->get();

        return view('prets.form', [
            'user' => Auth::user(),
            'livre_imprimes' => $livre_imprimes,
            'pret' => Pret::findOrFail($id),
            'informations_pret' => $informations_pret,
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $validateData = $request->validate([
                'date_debut' => ['required'],
                'date_fin_prevue' => ['required'],
                'livre_imprime_exemplaire_id' => ['required', 'array'],
            ], [
                'livre_imprime_exemplaire_id.required' => 'Choisissez au moins un ouvrage.',
                'date_debut.required' => 'Renseignez la date de début.',
                'date_fin_prevue.required' => 'Renseignez la date de fin prévue.',
            ]);

            $pret = Pret::findOrFail($id);

            $pret->update([
                'date_debut' => $validateData['date_debut'],
                'date_fin_prevue' => $validateData['date_fin_prevue'],
            ]);

            $taille = sizeof($validateData['livre_imprime_exemplaire_id']);

            for ($i = 0; $i < $taille; $i++) {
                DB::table('exemplaire_pretes')->insert([
                    'pret_id' => $id,
                    'livre_imprime_exemplaire_id' => $validateData['livre_imprime_exemplaire_id'][$i],
                ]);

                DB::table('livre_imprime_exemplaires')
                    ->where('id', '=', $validateData['livre_imprime_exemplaire_id'][$i])
                    ->update([
                        'statut' => 1,
                    ]);
            }

            return to_route('pret.index');
        } else {
            // Retourner la vue de mise à jour du prêt sans effectuer les modifications
        }
    }

    public function pret_retour_create($id)
    {

        $informations_pret = DB::table('prets')
            ->where('prets.id', '=', $id)
            ->join('users', 'users.id', '=', 'prets.user_id')
            ->join('abonnes', 'abonnes.id', '=', 'prets.abonne_id')
            ->first();

        $mes_prets = DB::table('prets')
            ->join('exemplaire_pretes', 'prets.id', '=', 'exemplaire_pretes.pret_id')
            ->join('livre_imprime_exemplaires', 'exemplaire_pretes.livre_imprime_exemplaire_id', '=', 'livre_imprime_exemplaires.id')
            ->join('livre_imprimes', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
            ->where('exemplaire_pretes.pret_id', '=', $id)
            ->where('exemplaire_pretes.retourne', '=', false) // Ajouter cette condition
            ->select('livre_imprimes.titre', 'livre_imprime_exemplaires.id as exemplaire_id')
            ->get();

        return view('prets.retour_form', [
            'user' => Auth::user(),
            'pret' => Pret::findOrFail($id),
            'mes_prets' => $mes_prets,
            'informations_pret' => $informations_pret,
        ]);
    }

    public function retour_pret($id)
    {
        // Mettre à jour le statut des exemplaires
        DB::table('livre_imprime_exemplaires')
            ->where('id', '=', $id)
            ->update([
                'statut' => 0,
            ]);
        // Autres actions que vous souhaitez effectuer lors du retour
        DB::table('exemplaire_pretes')
            ->where('livre_imprime_exemplaire_id', '=', $id)
            ->update([
                'retourne' => true,
            ]);
        // Rediriger vers la page d'accueil ou une autre vue appropriée
        return redirect()->back()->with('success', 'Le prêt a été retourné avec succès.');
    }
}
