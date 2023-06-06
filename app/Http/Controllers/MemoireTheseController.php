<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use App\Models\MemoireThese;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemoireTheseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('memoires.index', [
            'user' => Auth::user() ?: new User(),
            'memoires' => MemoireThese::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memoires.form', [
            'user' => Auth::user(),
            'entites' => Entite::all(),
            'options' => Option::all(),
            'memoire' => new MemoireThese(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Valider les données entrées par l'utilisateur
        $validatedData = $request->validate([
            'cote' => 'required',
            'theme' => 'required',
            'auteur' => 'required',
            'annee' => 'required|regex:/\d{4}-\d{4}/',
            'option_id' => 'required',
            'pdf' => 'file',
            'exemplaire' => 'required|integer',
        ], [
            'cote.required' => 'La cote  est obligatoire',
            'theme.required' => 'Le thème  est obligatoire',
            'auteur.required' => 'Le nom de l\'auteur est obligatoire',
            'annee.required' => 'L\' année  est obligatoire',
            'annee.regex' => 'L\' année doit suivre le format XXXX-YYYY',
            'exemplaire.required' => 'Indiquez le nombre d\'exemplaire',
        ]);

        $filename = $validatedData['cote'];
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $filename = $pdf->getClientOriginalName(); // Récupérer le nom d'origine du fichier avec son extension
            $pdfPath = $pdf->storeAs('public/pdfs', $validatedData['cote'] . $filename); // Stocker le fichier PDF dans le répertoire "pdfs" avec le nom d'origine
        } else {
            $pdfPath = null;
        }

        // Créer un nouvel objet Mémoire avec les données validées
        $memoire = new MemoireThese();
        $memoire->cote = $validatedData['cote'];
        $memoire->theme = $validatedData['theme'];
        $memoire->auteur = $validatedData['auteur'];
        $memoire->option_id = $validatedData['option_id'];
        $memoire->annee = $validatedData['annee'];
        $memoire->pdf = $pdfPath;
        $memoire->exemplaire = $validatedData['exemplaire'];

        // Enregistrer le Mémoire dans la base de données
        $memoire->save();

        // Rediriger vers une autre page ou afficher un message de succès
        return redirect()->route('memoire.index')->with('success', 'Le Mémoire a été enregistré avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $memoireThese = MemoireThese::findOrFail($id);
        return view('memoires.show', [
            'user' => Auth::user() ?: new User(),
            'memoire' => $memoireThese,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $memoireThese = MemoireThese::findOrFail($id);
        return view('memoires.form', [
            'user' => Auth::user(),
            'entites' => Entite::all(),
            'options' => Option::all(),
            'memoire' => $memoireThese,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $memoireThese = MemoireThese::findOrFail($id);
        $validatedData = $request->validate([
            'cote' => 'required',
            'theme' => 'required',
            'auteur' => 'required',
            'annee' => 'required|regex:/\d{4}-\d{4}/',
            'pdf' => 'file',
            'option_id' => 'required',
            'exemplaire' => 'required|integer',
        ], [
            'cote.required' => 'La cote est obligatoire',
            'theme.required' => 'Le thème est obligatoire',
            'auteur.required' => 'Le nom de l\'auteur est obligatoire',
            'annee.required' => 'L\'année est obligatoire',
            'annee.regex' => 'L\'année doit suivre le format XXXX-YYYY',
            'exemplaire.required' => 'Indiquez le nombre d\'exemplaire',
        ]);

        $pdfPath = $memoireThese->pdf;

        if (!$request->hasFile('pdf') && $memoireThese->pdf) {
            // Supprimer le fichier PDF existant
            Storage::delete($pdfPath);
            $pdfPath = null;
        }

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');

            if ($pdfPath) {
                // Supprimer l'ancien fichier PDF
                Storage::delete($pdfPath);
            }

            $filename = 'nouveau_nom.pdf'; // Remplacez 'nouveau_nom' par le nom souhaité

            // Vérifier les erreurs de téléchargement du fichier PDF
            if ($pdf->isValid()) {
                // Stocker le nouveau fichier PDF avec le nom personnalisé
                $pdfPath = $pdf->storeAs('public/pdfs', $filename);
            } else {
                // Gérer les erreurs de téléchargement du fichier
                return redirect()->back()->withErrors(['pdf' => 'Une erreur s\'est produite lors du téléchargement du fichier PDF.']);
            }
        }

        $memoireThese->update([
            'cote' => $validatedData['cote'],
            'auteur' => $validatedData['auteur'],
            'theme' => $validatedData['theme'],
            'annee' => $validatedData['annee'],
            'exemplaire' => $validatedData['exemplaire'],
            'option_id' => $validatedData['option_id'],
            'updated_at' => now(),
            'pdf' => $pdfPath,
        ]);

        return redirect()->route('memoire.index')->with('success', 'Le Mémoire a été modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $memoireThese = MemoireThese::findOrFail($id);
        $memoireThese->delete();
        return redirect()->back()->with('success', 'Document supprimé avec succès');
    }
}
