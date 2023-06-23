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
            ->groupBy('entites.intitule')
            ->having('total_consultations', '>', 0) // Condition pour les consultations effectuées
            ->get();

        return response()->json($memos);
    }

    public function get_livres($mois)
    {
        $livres = DB::table('categories')
            ->select(
                'categories.classe as categorie',
                DB::raw("COUNT(livre_imprime_consultes.id) as total_consultations")
            )
            ->join('divisions', 'categories.id', '=', 'divisions.category_id')
            ->join('livre_imprimes', 'divisions.id', '=', 'livre_imprimes.division_id')
            ->leftJoin('livre_imprime_consultes', 'livre_imprimes.id', '=', 'livre_imprime_consultes.livre_imprime_id')
            ->where(DB::raw("strftime('%Y-%m', livre_imprime_consultes.created_at)"), $mois)
            ->groupBy('categories.classe')
            ->having('total_consultations', '>', 0) // Condition pour les consultations effectuées
            ->get();

        return response()->json($livres);
    }

    public function get_prets($mois)
    {
        $prets = DB::table('categories')
            ->join('divisions', 'categories.id', '=', 'divisions.category_id')
            ->join('livre_imprimes', 'divisions.id', '=', 'livre_imprimes.division_id')
            ->leftJoin('livre_imprime_exemplaires', 'livre_imprimes.id', '=', 'livre_imprime_exemplaires.livre_imprime_id')
            ->leftJoin('exemplaire_pretes', 'livre_imprime_exemplaires.id', '=', 'exemplaire_pretes.livre_imprime_exemplaire_id')
            ->select(
                'categories.classe',
                DB::raw('COUNT(exemplaire_pretes.id) as nombre_prets')
            )
            ->where('exemplaire_pretes.retourne', true)
            ->where('exemplaire_pretes.updated_at', 'like', '%' . $mois . '%')
            ->groupBy('categories.classe')
            ->get();
        return response()->json($prets);
    }

    public function get_loges($rayonId)
    {
        $loges = DB::table('loges')
            ->where('rayon_id', '=', $rayonId)
            ->get();

        return response()->json($loges);
    }
}
