<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function get_options($entiteId)
    {
        $options = DB::table('options')
            ->where('entite_id', '=', $entiteId)
            ->get();
        return response()->json($options);
    }

    public function get_divisions($categoryId)
    {
        $divisions = DB::table('divisions')
            ->where('category_id', '=', $categoryId)
            ->get();
        return response()->json($divisions);
    }

    public function get_memos($mois)
    {
        $memos = DB::table('entites')
            ->select(
                'entites.intitule as entite',
                DB::raw("COUNT(memoire_these_consultes.id) as total_consultations")
            )
            ->join('options', 'entites.id', '=', 'options.entite_id')
            ->join('memoire_theses', 'options.id', '=', 'memoire_theses.option_id')
            ->leftJoin('memoire_these_consultes', 'memoire_theses.id', '=', 'memoire_these_consultes.memoire_these_id')
            ->where(DB::raw("strftime('%Y-%m', memoire_these_consultes.created_at)"), $mois)
            ->groupBy('entites.intitule', 'options.intitule', 'mois_annee')
            ->orderByDesc('mois_annee') // Ajout du tri par mois
            ->having('total_consultations', '>', 0) // Condition pour les consultations effectuées
            ->get();

        return response()->json($memos);
    }
}
