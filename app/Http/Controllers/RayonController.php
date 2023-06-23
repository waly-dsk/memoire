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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayon = Rayon::findOrFail($id);
        $rayon_loges = DB::table('rayons')
            ->join('loges', 'rayons.id', '=', 'loges.rayon_id')
            ->where('rayons.id', '=', $id)
            ->select(DB::raw('COUNT(loges.id) as nombre_de_loges'))
            ->groupBy('rayons.id', 'rayons.nom')
            ->first();

        if ($rayon == null) {
            return view('errors.404');
        }
        return view('rayon.form', [
            'user' => Auth::user(),
            'rayon' => $rayon,
            'rayon_loges' => $rayon_loges,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $rayonId)
    {
        $validateData = $request->validate([
            'nom' => ['required', 'regex:/^Rayon\s\d+$/'],
            'nombre_de_loges' => 'required|integer|min:1',
        ], [
            'nom.required' => "Le nom du rayon est requis",
            'nom.regex' => "Ce nom de rayon n'est pas valide",
            'nombre_de_loges.required' => "Indiquer le nombre de loges pour le rayon",
            'nombre_de_loges.min' => "Minimum 1",
        ]);

        $rayon = Rayon::findOrFail($rayonId);

        $rayon->nom = $validateData['nom'];
        $rayon->save();

        // Supprimer les loges existantes
        DB::table('loges')->where('rayon_id', $rayon->id)->delete();

        for ($i = 1; $i <= (int) $validateData['nombre_de_loges']; $i++) {
            DB::table('loges')->insert([
                'rayon_id' => $rayon->id,
                'nom' => $validateData['nom'] . ' - Loge ' . $i,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('rayon.index')->with('success', "Mise à jour réussie");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rayonId)
    {
        $rayon = Rayon::findOrFail($rayonId);

        // Supprimer les loges associées au rayon
        DB::table('loges')->where('rayon_id', $rayon->id)->delete();

        // Supprimer le rayon lui-même
        $rayon->delete();

        return redirect()->route('rayon.index')->with('success', "Rayon supprimé avec succès");
    }
}
