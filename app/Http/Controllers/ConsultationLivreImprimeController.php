<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsultationLivreImprime;
use App\Models\LivreImprime;

class ConsultationLivreImprimeController extends Controller
{
    public function create()
    {
        return view('consultations_livres_imprimes.form', [
            'user' => Auth::user(),
            'consultation' => new ConsultationLivreImprime(),
            'livre_imprimes' => LivreImprime::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'livre_imprime_id' => 'required',
        ], [
            'livre_imprime_id.required' => "Choisissez au moins un livre"
        ]);

        for ($i = 0; $i < sizeof($validateData['livre_imprime_id']); $i++) {
            DB::table('livre_imprime_consultes')->insert([
                'livre_imprime_id' => $validateData['livre_imprime_id'][$i],
                'created_at' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'Consultation enregsitrée avec succès !');
    }
}
