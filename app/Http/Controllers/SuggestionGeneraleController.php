<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchSuggestionGeneraleRequest;

class SuggestionGeneraleController extends Controller
{

    public function index(SearchSuggestionGeneraleRequest $request)
    {

        $types = DB::table('type_suggestions')
            ->get();

        $dates_ajout = DB::table('suggestion_generales')
            ->select(DB::raw("strftime('%Y-%m', created_at) as mois_annee"))
            ->groupBy('mois_annee')
            ->orderByDesc('mois_annee')
            ->get();

        $suggestions = DB::table('suggestion_generales')
            ->join('type_suggestions', 'type_suggestions.id', '=', 'suggestion_generales.type_suggestion_id')
            ->select('suggestion_generales.*', 'type_suggestions.intitule')
            ->orderBy('suggestion_generales.created_at', 'desc')
            ->get();

        if ($type = $request->validated('type')) {
            $suggestions = DB::table('suggestion_generales')
                ->join('type_suggestions', 'type_suggestions.id', '=', 'suggestion_generales.type_suggestion_id')
                ->select('suggestion_generales.*', 'type_suggestions.created_at as ddate', 'type_suggestions.intitule')
                ->where('type_suggestion_id', '=',  $type)
                ->orderBy('suggestion_generales.created_at', 'desc')
                ->get();
        }

        if ($mot_cles = $request->validated('mot_cles')) {
            $suggestions = DB::table('suggestion_generales')
                ->join('type_suggestions', 'type_suggestions.id', '=', 'suggestion_generales.type_suggestion_id')
                ->select('suggestion_generales.*', 'type_suggestions.intitule')
                ->orderBy('suggestion_generales.created_at', 'desc')
                ->where('suggestion_generales.contenu', 'like', '%' . $mot_cles . '%')
                ->get();
        }



        if ($date_ajout = $request->validated('date_ajout')) {
            $suggestions = DB::table('suggestion_generales')
                ->join('type_suggestions', 'type_suggestions.id', '=', 'suggestion_generales.type_suggestion_id')
                ->select('suggestion_generales.*', 'type_suggestions.created_at as ddate', 'type_suggestions.intitule')
                ->where('suggestion_generales.created_at', 'like', '%' . $date_ajout . '%')
                ->get();
        }

        return view('suggestion_generale.index', [
            'user' => Auth::user() ?: new User(),
            'suggestions' => $suggestions,
            'dates_ajout' => $dates_ajout,
            'types' => $types,
            'input' => $request->validated(),
        ]);
    }
    public function create()
    {
        $types = DB::table('type_suggestions')
            ->get();
        return view('suggestion_generale.create', [
            'user' => Auth::user() ?: new User(),
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'type_suggestion_id' => 'required',
            'contenu' => 'required',
        ], [
            'type_suggestion_id.required' => 'Choisissez un type de Suggestion',
            'contenu.required' => 'Contenu requis',
        ]);

        DB::table('suggestion_generales')->insert([
            'type_suggestion_id' => $validateData['type_suggestion_id'],
            'contenu' => $validateData['contenu'],
            'created_at' => now(),
        ]);

        return to_route('suggestion_generale.index')->with('success', 'Suggestion bien ajoutée.');
    }

    public function destroy($id)
    {
        DB::table('suggestion_generales')->where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Suggestion supprimée avec succès.');
    }
}
