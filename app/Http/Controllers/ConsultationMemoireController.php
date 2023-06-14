<?php

namespace App\Http\Controllers;

use App\Models\MemoireThese;
use App\Models\ConsultationMemoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConsultationMemoireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consultations_memoires_theses.index', [
            'user' => Auth::user(),
            'consultations' => DB::table('memoire_these_consultes')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultations_memoires_theses.form', [
            'user' => Auth::user(),
            'consultation' => new ConsultationMemoire(),
            'memoires' => MemoireThese::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'memoire_id' => 'required',
        ], [
            'memoire_id.required' => "Choisissez au moins un mémoire / thèse"
        ]);

        for ($i = 0; $i < sizeof($validateData['memoire_id']); $i++) {
            DB::table('memoire_these_consultes')->insert([
                'memoire_these_id' => $validateData['memoire_id'][$i],
                'created_at' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'Consultation enregsitrée avec succès !');
    }
}
