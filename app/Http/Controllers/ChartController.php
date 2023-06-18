<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function consultations_memoires_theses()
    {
        $mois = DB::table('memoire_these_consultes')
            ->select(DB::raw("strftime('%Y-%m', created_at) as mois_annee"))
            ->groupBy('mois_annee')
            ->orderByDesc('mois_annee')
            ->get();

        return view('charts.consultation_memoires_theses', [
            'user' => Auth::user(),
            'mois' => $mois,
        ]);
    }

    public function consultations_livres_imprimes()
    {
        $mois = DB::table('livre_imprime_consultes')
            ->select(DB::raw("strftime('%Y-%m', created_at) as mois_annee"))
            ->groupBy('mois_annee')
            ->orderByDesc('mois_annee')
            ->get();

        return view('charts.consultation_livres_imprimes', [
            'user' => Auth::user(),
            'mois' => $mois,
        ]);
    }
}
