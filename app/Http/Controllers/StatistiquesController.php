<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatistiquesController extends Controller
{
    public function stats_memoires_theses()
    {
        $memos = DB::table('entites')
            ->select(
                'entites.intitule as entite',
                DB::raw("GROUP_CONCAT(options.intitule, ', ') as options"),
                DB::raw("GROUP_CONCAT(memoire_theses.id || ':' || memoire_theses.cote, ';') as memoires"),
                DB::raw("strftime('%Y-%m', memoire_these_consultes.created_at) as mois_annee"),
                DB::raw("COUNT(memoire_these_consultes.id) as total_consultations")
            )
            ->join('options', 'entites.id', '=', 'options.entite_id')
            ->join('memoire_theses', 'options.id', '=', 'memoire_theses.option_id')
            ->leftJoin('memoire_these_consultes', 'memoire_theses.id', '=', 'memoire_these_consultes.memoire_these_id')
            ->groupBy('entites.intitule', 'options.intitule', 'mois_annee')
            ->orderByDesc('mois_annee') // Ajout du tri par mois
            ->having('total_consultations', '>', 0) // Condition pour les consultations effectuées
            ->get();
        // Affichez les statistiques par mois
        return view('stats_consultations.memoire', [
            'user' => Auth::user(),
            'memos' => $memos,
        ]);
    }

    public function stats_livres_imprimes()
    {
        $stats = DB::table('livre_imprimes')
            ->join('divisions', 'livre_imprimes.division_id', '=', 'divisions.id')
            ->join('categories', 'divisions.category_id', '=', 'categories.id')
            ->leftJoin('livre_imprime_consultes', 'livre_imprimes.id', '=', 'livre_imprime_consultes.livre_imprime_id')
            ->select(
                'categories.intitule as categorie',
                DB::raw("GROUP_CONCAT(divisions.intitule, ', ') as divisions"),
                DB::raw("GROUP_CONCAT(livre_imprimes.id || ':' || livre_imprimes.cote, ';') as livre_imprimes"),
                DB::raw("strftime('%Y-%m', livre_imprime_consultes.created_at) as mois_annee"),
                DB::raw("COUNT(livre_imprime_consultes.id) as total_consultations")
            )
            ->groupBy('categories.intitule', 'divisions.intitule',  'mois_annee')
            ->orderByDesc('mois_annee') // Ajout du tri par mois
            ->having('total_consultations', '>', 0) // Condition pour les consultations effectuées
            ->get();

        return view('stats_consultations.livre_imprimes', [
            'user' => Auth::user(),
            'stats' => $stats,
        ]);
    }
}
