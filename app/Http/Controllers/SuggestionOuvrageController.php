<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchSuggestionOuvrageRequest;

class SuggestionOuvrageController extends Controller
{

    public function index(SearchSuggestionOuvrageRequest $request)
    {
        $dates_ajout = DB::table('suggestion_ouvrages')
            ->select(DB::raw("strftime('%Y-%m', created_at) as mois_annee"))
            ->groupBy('mois_annee')
            ->orderByDesc('mois_annee')
            ->get();


        $suggestions = DB::table('suggestion_ouvrages')
            ->join('categories', 'suggestion_ouvrages.category_id', '=', 'categories.id')
            ->orderBy('suggestion_ouvrages.created_at', 'desc')
            ->paginate(5);


        if ($category_id = $request->validated('category_id')) {
            $suggestions = DB::table('suggestion_ouvrages')
                ->join('categories', 'suggestion_ouvrages.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $category_id)
                ->paginate(5);
        }


        if ($auteur = $request->validated('auteur')) {
            $suggestions = DB::table('suggestion_ouvrages')
                ->join('categories', 'suggestion_ouvrages.category_id', '=', 'categories.id')

                ->where('suggestion_ouvrages.auteur', 'like', '%' . $auteur . '%')
                ->paginate(5);
        }


        if ($mot_cles = $request->validated('mot_cles')) {
            $suggestions = DB::table('suggestion_ouvrages')
                ->join('categories', 'suggestion_ouvrages.category_id', '=', 'categories.id')
                ->where('suggestion_ouvrages.titre', 'like', '%' . $mot_cles . '%')
                ->paginate(5);
        }


        if ($date_ajout = $request->validated('date_ajout')) {
            $suggestions = DB::table('suggestion_ouvrages')
                ->join('categories', 'suggestion_ouvrages.category_id', '=', 'categories.id')

                ->where('suggestion_ouvrages.created_at', 'like', '%' . $date_ajout . '%')
                ->paginate(5);
        }

        $categories = DB::table('categories')->get();

        return view('suggestion_ouvrage.index', [
            'user' => Auth::user() ?: new User(),
            'suggestions' => $suggestions,
            'categories' => $categories,
            'dates_ajout' => $dates_ajout,
            'input' => $request->validated(),
        ]);
    }


    public function create()
    {
        $categories = DB::table('categories')
            ->get();

        return view('suggestion_ouvrage.create', [
            'user' => Auth::user() ?: new User(),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'titre' => 'required',
            'edition' => 'required',
            'annee_parution' => 'required',
            'auteur' => 'required',
        ], [
            'category_id.required' => 'Catégorie requise',
            'titre.required' => 'Titre requis.',
            'edition.required' => 'Édition requise.',
            'annee_parution.required' => 'Indiquez l \'année  de parution.',
            'auteur.required' => 'Indiquez l \'auteur.',
        ]);

        DB::table('suggestion_ouvrages')->insert([
            'category_id' => $validateData['category_id'],
            'titre' => $validateData['titre'],
            'edition' => $validateData['edition'],
            'annee_parution' => $validateData['annee_parution'],
            'auteur' => $validateData['auteur'],
            'created_at' => now(),
        ]);

        return to_route('suggestion_ouvrage.index');
    }

    public function destroy($id)
    {
        DB::table('suggestion_ouvrages')->where('id', '=', $id)->delete();
        return to_route('suggestion_ouvrages.index')->with('success', 'Suggestion supprimée avec succès');
    }
}
