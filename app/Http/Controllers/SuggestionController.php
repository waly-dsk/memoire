<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
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

        return back()->with('success', 'Suggestion enregistrée avec succès');
    }
}
