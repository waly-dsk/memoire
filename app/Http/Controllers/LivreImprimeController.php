<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LivreImprime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LivreImprimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('livre_imprimes.index', [
            'user' => Auth::user() ?: new User(),
            'livre_imprimes' => LivreImprime::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livre_imprimes.form', [
            'user' => Auth::user(),
            'livre_imprime' => new LivreImprime(),
            'categories' => DB::table('categories')->get(),
            'divisions' => DB::table('divisions')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'cote' => 'required',
            'titre' => 'required',
            'auteur' => 'required',
            'division_id' => 'required',
            'exemplaire' => 'required',
            'cote' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LivreImprime $livreImprime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LivreImprime $livreImprime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LivreImprime $livreImprime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LivreImprime $livreImprime)
    {
        //
    }
}
