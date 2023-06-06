<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{

    public function index()
    {
        return view('suggestion.index', [
            'user' => Auth::user() ?: new User(),
            'suggestions' => Suggestion::latest()->paginate(1),
        ]);
    }
    public function create()
    {
        return view('suggestion.create', [
            'user' => new User(),
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

        return to_route('suggestion.index')->with('success', 'Suggestion enregistrée avec succès');
    }
}
