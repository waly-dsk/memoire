<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayons = DB::table('rayons')
            ->leftJoin('loges', 'rayons.id', '=', 'loges.rayon_id')
            ->select('rayons.id', 'rayons.created_at', 'rayons.nom', DB::raw('GROUP_CONCAT(loges.nom) as loges'))
            ->groupBy('rayons.id', 'rayons.nom')
            ->orderByDesc('rayons.created_at')
            ->get();

        return view('rayon.index', [
            'user' => Auth::user(),
            'rayons' => $rayons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rayon.form', [
            'user' => Auth::user(),
            'rayon' => new Rayon(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nom' => 'required|unique:rayons,nom|regex:/^Rayon\s\d+$/',
            'nombre_de_loges' => 'required|integer|min:1',
        ], [
            'nom.required' => "Le nom du rayon est requis",
            'nom.unique' => "Ce nom de rayon a déjà été utilisé",
            'nom.regex' => "Ce nom de rayon n'est pas valide",
            'nombre_de_loges.required' => "Indiquer le nombre de loges pour le rayon",
            'nombre_de_loges.min' => "Minimum 1",
        ]);

        $rayon = new Rayon();

        $rayon->nom = $validateData['nom'];
        $rayon->save();
        $rayon_id = $rayon->id;
        for ($i = 1; $i <= (int) ($validateData['nombre_de_loges']); $i++) {
            DB::table('loges')->insert([
                'rayon_id' => $rayon_id,
                'nom' => $validateData['nom'] . ' - Loge ' . $i,
                'created_at' => now(),
            ]);
        }
        return to_route('rayon.index')->with('success', "Enregistrment avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(Rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rayon $rayon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rayon $rayon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rayon $rayon)
    {
        //
    }
}
