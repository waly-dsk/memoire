<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchLivreImprimeRequest;
use App\Models\User;
use App\Models\LivreImprime;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LivreImprimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchLivreImprimeRequest $request, $division_id)
    {
        if (!(is_numeric($division_id) && $division_id >= 1 && $division_id <= 100)) {
            return view('errors.404');
        }
        $sous_categorie = DB::table('divisions')
            ->where('id', '=', $division_id)
            ->select('intitule')
            ->first();

        $livresAvecExemplaires = LivreImprime::leftJoin(
            'livre_imprime_exemplaires',
            'livre_imprimes.id',
            '=',
            'livre_imprime_exemplaires.livre_imprime_id'
        )
            ->join('loges', 'loges.id', 'livre_imprimes.loge_id')
            ->join('divisions', 'divisions.id', 'livre_imprimes.division_id')
            ->join('categories', 'categories.id', 'divisions.category_id')
            ->where('livre_imprimes.division_id', '=', $division_id)
            ->where('livre_imprime_exemplaires.statut', '=', 0)

            ->select(
                'livre_imprimes.*',
                DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'),
                'loges.nom as emplacement',
                'categories.intitule as category_name',
                'divisions.intitule as division_name',
            )
            ->groupBy('livre_imprimes.id')
            ->get();

        if ($cote = $request->validated('cote')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->join('loges', 'loges.id', 'livre_imprimes.loge_id')
                ->join('divisions', 'divisions.id', 'livre_imprimes.division_id')
                ->join('categories', 'categories.id', 'divisions.category_id')

                ->where('livre_imprime_exemplaires.statut', '=', 0)
                ->where('livre_imprimes.division_id', '=', $division_id)
                ->where('livre_imprimes.cote', 'like', '%' . $cote . '%')

                ->select(
                    'livre_imprimes.*',
                    DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'),
                    'loges.nom as emplacement',
                    'categories.intitule as category_name',
                    'divisions.intitule as division_name',
                )
                ->groupBy('livre_imprimes.id')
                ->get();
        }

        if ($auteur = $request->validated('auteur')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->join('loges', 'loges.id', 'livre_imprimes.loge_id')
                ->join('divisions', 'divisions.id', 'livre_imprimes.division_id')
                ->join('categories', 'categories.id', 'divisions.category_id')

                ->where('livre_imprime_exemplaires.statut', '=', 0)
                ->where('livre_imprimes.division_id', '=', $division_id)
                ->where('livre_imprimes.auteur', 'like', '%' . $auteur . '%')
                ->select(
                    'livre_imprimes.*',
                    DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'),
                    'loges.nom as emplacement',
                    'categories.intitule as category_name',
                    'divisions.intitule as division_name',
                )
                ->groupBy('livre_imprimes.id')
                ->get();
        }

        if ($mots_cles = $request->validated('mots_cles')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->join('loges', 'loges.id', 'livre_imprimes.loge_id')
                ->join('divisions', 'divisions.id', 'livre_imprimes.division_id')
                ->join('categories', 'categories.id', 'divisions.category_id')

                ->where('livre_imprime_exemplaires.statut', '=', 0)
                ->where('livre_imprimes.division_id', '=', $division_id)
                ->where('livre_imprimes.titre', 'like', '%' . $mots_cles . '%')
                ->select(
                    'livre_imprimes.*',
                    DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'),
                    'loges.nom as emplacement',
                    'categories.intitule as category_name',
                    'divisions.intitule as division_name',
                )
                ->groupBy('livre_imprimes.id')
                ->get();
        }

        return view('livre_imprimes.index', [
            'user' => Auth::user() ?: new User(),
            'livre_imprimes' => $livresAvecExemplaires,
            'sous_categorie' => $sous_categorie,
            'input' => $request->validated(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livre_imprimes.form', [
            'user' => Auth::user(),
            'livre_imprime' => new LivreImprime(),
            'rayons' => Rayon::all(),
            'loges' => DB::table('loges')->get(),
            'categories' => DB::table('categories')->get(),
            'divisions' => DB::table('divisions')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'cote' => 'required|unique:livre_imprimes,cote',
            'titre' => 'required',
            'auteur' => 'required',
            'division_id' => 'required',
            'loge_id' => 'required',
            'exemplaire' => 'required',
        ], [
            'cote.required' => "La cote de l'ouvrage est à renseigner.",
            'cote.unique' => 'Cette cote existe déjà pour un autre ouvrage.',
            'titre.required' => "Le titre de l'ouvrage est à renseigner.",
            'auteur.required' => "L'auteur de l'ouvrage est à renseigner.",
        ]);

        $livreImprime = new LivreImprime();
        $livreImprime->cote = $validateData['cote'];
        $livreImprime->titre = $validateData['titre'];
        $livreImprime->auteur = $validateData['auteur'];
        $livreImprime->division_id = $validateData['division_id'];
        $livreImprime->loge_id = $validateData['loge_id'];
        $livreImprime->save();

        $livreImprimeId = $livreImprime->id;

        $exemplaire = (int)$validateData['exemplaire'];
        $i = 0;
        for ($i = 0; $i < $exemplaire; $i++) {
            DB::table('livre_imprime_exemplaires')->insert([
                'livre_imprime_id' => $livreImprimeId,
            ]);
        }
        return to_route('livre_imprime.index', ['division_id' => $validateData['division_id']])->with('success', 'Livre Iprimé Ajouté avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return view('errors.404');
        }
        $livreImprime = DB::table('livre_imprimes')
            ->join('loges', 'livre_imprimes.loge_id', '=', 'loges.id')
            ->join('divisions', 'livre_imprimes.division_id', '=', 'divisions.id')
            ->join('categories', 'divisions.category_id', '=', 'categories.id')
            ->join('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
            ->where('livre_imprime_exemplaires.statut', '=', 0)
            ->select(
                'livre_imprimes.*',
                'divisions.intitule AS division_intitule',
                'categories.intitule AS categorie_intitule',
                'loges.nom AS emplacement',
                DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires')
            )
            ->where('livre_imprimes.id', $id)
            ->first();

        if ($livreImprime == null) {
            return view('errors.404');
        }

        return view('livre_imprimes.show', [
            'user' => Auth::user() ?: new User(),
            'livre_imprime' => $livreImprime,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $livreImprime = LivreImprime::findOrFail($id);
        return view('livre_imprimes.form', [
            'user' => Auth::user(),
            'livre_imprime' => $livreImprime,
            'categories' => DB::table('categories')->get(),
            'divisions' => DB::table('divisions')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $livreImprime = LivreImprime::findOrFail($id);

        DB::table('livre_imprime_exemplaires')->where('livre_imprime_id', $id)->delete();
        $validateData = $request->validate([
            'cote' => 'required',
            'titre' => 'required',
            'emplacement' => 'required',
            'auteur' => 'required',
            'division_id' => 'required',
            'exemplaire' => 'required',
        ]);
        $livreImprime->update([
            'cote' => $validateData['cote'],
            'titre' => $validateData['titre'],
            'auteur' => $validateData['auteur'],
            'emplacement' => $validateData['emplacement'],
            'division_id' => $validateData['division_id'],
        ]);

        $exemplaire = (int)$validateData['exemplaire'];

        $i = 0;
        for ($i = 0; $i < $exemplaire; $i++) {
            DB::table('livre_imprime_exemplaires')->insert([
                'livre_imprime_id' => $id,
            ]);
        }
        return redirect('livre_imprime');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $livreImprime = LivreImprime::findOrFail($id);
        $livreImprime->delete();
        return redirect()->back();
    }
}
