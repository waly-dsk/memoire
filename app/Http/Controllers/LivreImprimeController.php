<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchLivreImprimeRequest;
use App\Models\User;
use App\Models\LivreImprime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LivreImprimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchLivreImprimeRequest $request)
    {
        $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
            ->where('livre_imprime_exemplaires.statut', '=', 0) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
            ->select('livre_imprimes.*', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
            ->groupBy('livre_imprimes.id')
            ->paginate(15);

        if ($cote = $request->validated('cote')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->where('livre_imprime_exemplaires.statut', '=', 0) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->where('livre_imprimes.cote', '=', $cote) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->select('livre_imprimes.*', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
                ->groupBy('livre_imprimes.id')
                ->paginate(15);
        }

        if ($classe = $request->validated('classe')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->join('divisions', 'divisions.id', '=', 'livre_imprimes.division_id')
                ->join('categories', 'categories.id', '=', 'divisions.category_id')
                ->where('livre_imprime_exemplaires.statut', '=', 0) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->where('categories.classe', '=', $classe) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->select('livre_imprimes.*', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
                ->groupBy('livre_imprimes.id')
                ->paginate(15);
        }

        if ($auteur = $request->validated('auteur')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->where('livre_imprime_exemplaires.statut', '=', 0) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->where('livre_imprimes.auteur', 'like', '%' . $auteur . '%') // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->select('livre_imprimes.*', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
                ->groupBy('livre_imprimes.id')
                ->paginate(15);
        }

        if ($titre = $request->validated('titre')) {
            $livresAvecExemplaires = LivreImprime::leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
                ->where('livre_imprime_exemplaires.statut', '=', 0) // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->where('livre_imprimes.titre', 'like', '%' . $titre . '%') // Ajoutez cette ligne pour filtrer les exemplaires avec le statut = 0
                ->select('livre_imprimes.*', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
                ->groupBy('livre_imprimes.id')
                ->paginate(15);
        }

        return view('livre_imprimes.index', [
            'user' => Auth::user() ?: new User(),
            'livre_imprimes' => $livresAvecExemplaires,
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
            'emplacement' => 'required',
            'division_id' => 'required',
            'exemplaire' => 'required',
        ], [
            'cote.required' => "La cote de l'ouvrage est à renseigner.",
            'cote.unique' => 'Cette cote existe déjà pour un autre ouvrage.',
        ]);
        $livreImprime = new LivreImprime();
        $livreImprime->cote = $validateData['cote'];
        $livreImprime->titre = $validateData['titre'];
        $livreImprime->auteur = $validateData['auteur'];
        $livreImprime->emplacement = $validateData['emplacement'];
        $livreImprime->division_id = $validateData['division_id'];
        $livreImprime->save();

        $livreImprimeId = $livreImprime->id;

        $exemplaire = (int)$validateData['exemplaire'];
        $i = 0;
        for ($i = 0; $i < $exemplaire; $i++) {
            DB::table('livre_imprime_exemplaires')->insert([
                'livre_imprime_id' => $livreImprimeId,
            ]);
        }
        return redirect('livre_imprime')->with('success', 'Livre Iprimé Ajouté avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $livreImprime = DB::table('livre_imprimes')
            ->join('divisions', 'livre_imprimes.division_id', '=', 'divisions.id')
            ->join('categories', 'divisions.category_id', '=', 'categories.id')
            ->join('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
            ->where('livre_imprime_exemplaires.statut', '=', 0)
            ->select('livre_imprimes.*', 'divisions.intitule AS division_intitule', 'categories.intitule AS categorie_intitule', DB::raw('COUNT(livre_imprime_exemplaires.id) as nombre_exemplaires'))
            ->where('livre_imprimes.id', $id)
            ->first();

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
