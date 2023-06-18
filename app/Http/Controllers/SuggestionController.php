<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchSuggestionRequest;
use App\Models\User;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{

    public function index(SearchSuggestionRequest $request)
    {
        $dates_ajout = DB::table('suggestions')
            ->select(DB::raw("strftime('%Y-%m', created_at) as mois_annee"))
            ->groupBy('mois_annee')
            ->orderByDesc('mois_annee')
            ->get();

        $suggestions = Suggestion::latest()->paginate(5);

        if ($categorie = $request->validated('categorie')) {
            $suggestions = DB::table('suggestions')
                ->where('categorie', '=', $categorie)
                ->paginate(5);
        }


        if ($auteur = $request->validated('auteur')) {
            $suggestions = DB::table('suggestions')
                ->where('auteur', '=', $auteur)
                ->paginate(5);
        }


        if ($titre = $request->validated('titre')) {
            $suggestions = DB::table('suggestions')
                ->where('titre', 'like', '%' . $titre . '%')
                ->paginate(5);
        }


        if ($date_ajout = $request->validated('date_ajout')) {
            $suggestions = DB::table('suggestions')
                ->where('created_at', 'like', '%' . $date_ajout . '%')
                ->paginate(5);
        }

        return view('suggestion.index', [
            'user' => Auth::user() ?: new User(),
            'suggestions' => $suggestions,
            'suggestionCount' => Suggestion::count(),
            'dates_ajout' => $dates_ajout,
            'input' => $request->validated(),
        ]);
    }
    public function create()
    {
        return view('suggestion.create', [
            'user' => Auth::user() ?: new User(),
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'categorie' => 'required',
            'titre' => 'required',
            'auteur' => 'required',
        ], [
            'categorie.required' => 'Catégorie requise',
            'titre.required' => 'Titre requis',
            'auteur.required' => 'Auteur requis',
        ]);
        Suggestion::create($validateData);

        return to_route('suggestion.index');
    }

    public function destroy($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $suggestion->delete();
        return to_route('suggestion.index')->with('success', 'Suggestion supprimée avec succès');
    }
}
