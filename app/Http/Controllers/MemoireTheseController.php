<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchMemoireTheseRequest;
use App\Models\User;
use App\Models\Entite;
use App\Models\Option;
use App\Models\MemoireThese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemoireTheseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(SearchMemoireTheseRequest $request, $type)
    {

        $documents = DB::table('memoire_theses')
            ->join('options', 'memoire_theses.option_id', '=', 'options.id')
            ->join('entites', 'options.entite_id', '=', 'entites.id')
            ->where('memoire_theses.type_document_id', '=', $type)
            ->orderBy('entites.intitule')
            ->select('memoire_theses.*', 'entites.intitule as entite', 'options.intitule as option')
            ->get();

        if ($annee = $request->validated('annee')) {
            $documents = DB::table('memoire_theses')
                ->join('options', 'memoire_theses.option_id', '=', 'options.id')
                ->join('entites', 'options.entite_id', '=', 'entites.id')
                ->where('memoire_theses.type_document_id', '=', $type)
                ->where('memoire_theses.annee', '=', $annee)
                ->orderBy('entites.intitule')
                ->select('memoire_theses.*', 'entites.intitule as entite', 'options.intitule as option')
                ->get();
        }

        if ($entite = $request->validated('entite')) {
            $documents = DB::table('memoire_theses')
                ->join('options', 'memoire_theses.option_id', '=', 'options.id')
                ->join('entites', 'options.entite_id', '=', 'entites.id')
                ->where('memoire_theses.type_document_id', '=', $type)
                ->where('entites.intitule', '=', $entite)
                ->orderBy('entites.intitule')
                ->select('memoire_theses.*', 'entites.intitule as entite', 'options.intitule as option')
                ->get();
        }

        if ($mots_cles = $request->validated('mots_cles')) {
            $documents = DB::table('memoire_theses')
                ->join('options', 'memoire_theses.option_id', '=', 'options.id')
                ->join('entites', 'options.entite_id', '=', 'entites.id')
                ->where('memoire_theses.type_document_id', '=', $type)
                ->where('memoire_theses.theme', 'like', '%' . $mots_cles . '%')
                ->orderBy('entites.intitule')
                ->select('memoire_theses.*', 'entites.intitule as entite', 'options.intitule as option')
                ->get();
        }

        if ($encadreur = $request->validated('encadreur')) {
            $documents = DB::table('memoire_theses')
                ->join('options', 'memoire_theses.option_id', '=', 'options.id')
                ->join('entites', 'options.entite_id', '=', 'entites.id')
                ->where('memoire_theses.type_document_id', '=', $type)

                ->where('memoire_theses.encadreur', 'like', '%' . $encadreur . '%')
                ->orderBy('entites.intitule')
                ->select('memoire_theses.*', 'entites.intitule as entite', 'options.intitule as option')
                ->get();
        }
        $type_information = DB::table('type_documents')->where('id', '=', $type)->first();
        if ($type_information === null) {
            // Le type d'information n'a pas été trouvé
            return view('errors.404');
        }
        return view('memoires_theses.index', [
            'user' => Auth::user() ?: new User(),
            'documents' => $documents,
            'type_information' => $type_information,
            'input' => $request->validated(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type_document)
    {
        $document = new MemoireThese();
        $document->fill([
            'exemplaire' => 2,
        ]);

        $types = DB::table('type_documents')->get();
        $type_information = DB::table('type_documents')->where('id', '=', $type_document)->first();
        if ($type_information === null) {
            // Le type d'information n'a pas été trouvé
            return view('errors.404');
        }
        return view('memoires_theses.form', [
            'user' => Auth::user(),
            'entites' => Entite::all(),
            'options' => Option::all(),
            'document' => $document,
            'types' => $types,
            'type_document' => $type_document,
            'type_information' => $type_information,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Valider les données entrées par l'utilisateur
        $validatedData = $request->validate([
            'type_document_id' => 'required',
            'cote' => 'required|unique:memoire_theses,cote',
            'theme' => 'required',
            'auteur' => 'required',
            'encadreur' => 'required',
            'annee' => 'required|regex:/\d{4}-\d{4}/',
            'option_id' => 'required',
            'pdf' => 'file',
            'exemplaire' => 'required|integer',
        ], [
            'type_document_id.required' => "Choisissez un Type",
            'cote.required' => 'La cote  est obligatoire',
            'cote.unique' => 'Cette cote a déjà été utilisée',
            'theme.required' => 'Le thème  est obligatoire',
            'auteur.required' => 'Le nom de l\'auteur est obligatoire',
            'encadreur.required' => 'Le nom de l\'encadreur est obligatoire',
            'annee.required' => 'L\' année  est obligatoire',
            'annee.regex' => 'L\' année doit suivre le format XXXX-YYYY',
            'exemplaire.required' => 'Indiquez le nombre d\'exemplaire',
        ]);

        $filename = $validatedData['cote'];
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $filename = $pdf->getClientOriginalName(); // Récupérer le nom d'origine du fichier avec son extension
            $pdfPath = $pdf->storeAs('public/memoires_theses', $validatedData['cote'] . $filename); // Stocker le fichier PDF dans le répertoire "pdfs" avec le nom d'origine
        } else {
            $pdfPath = null;
        }

        // Créer un nouvel objet Mémoire avec les données validées
        $document = new MemoireThese();
        $document->type_document_id = $validatedData['type_document_id'];
        $document->cote = $validatedData['cote'];
        $document->theme = $validatedData['theme'];
        $document->encadreur = $validatedData['encadreur'];
        $document->auteur = $validatedData['auteur'];
        $document->option_id = $validatedData['option_id'];
        $document->annee = $validatedData['annee'];
        $document->pdf = $pdfPath;
        $document->exemplaire = $validatedData['exemplaire'];

        // Enregistrer le Mémoire dans la base de données
        $document->save();

        // Rediriger vers une autre page ou afficher un message de succès
        return redirect()->route('memoires_theses.type_index', ['type' => $validatedData['type_document_id']]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = DB::table('memoire_theses')
            ->join('type_documents', 'type_documents.id', '=', 'memoire_theses.type_document_id')
            ->join('options', 'options.id', '=', 'memoire_theses.option_id')
            ->join('entites', 'entites.id', '=', 'options.entite_id')
            ->select(
                'entites.intitule as entite',
                'options.intitule as option',
                'memoire_theses.*',
                'type_documents.id as type_id',
                'type_documents.intitule as type_document',
            )
            ->where('memoire_theses.id', '=', $id)
            ->first();

        if ($document == null) {
            // Le type d'information n'a pas été trouvé
            return view('errors.404');
        }
        return view('memoires_theses.show', [
            'user' => Auth::user() ?: new User(),
            'document' => $document,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $document = MemoireThese::findOrFail($id);

        $types = DB::table('type_documents')->get();

        $type_information = DB::table('type_documents')
            ->join('memoire_theses', 'type_documents.id', '=', 'memoire_theses.type_document_id')
            ->where('memoire_theses.id', '=', $id)
            ->select('type_documents.*')
            ->first();

        if ($type_information === null) {
            // Le type d'information n'a pas été trouvé
            return view('errors.404');
        }
        return view('memoires_theses.form', [
            'user' => Auth::user(),
            'entites' => Entite::all(),
            'options' => Option::all(),
            'document' => $document,
            'types' => $types,
            'type_information' => $type_information,
            'type_document' => $type_information->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $document = MemoireThese::findOrFail($id);
        $validatedData = $request->validate([
            'type_document_id' => 'required',
            'cote' => 'required',
            'theme' => 'required',
            'auteur' => 'required',
            'encadreur' => 'required',
            'annee' => 'required|regex:/\d{4}-\d{4}/',
            'option_id' => 'required',
            'pdf' => 'file',
            'exemplaire' => 'required|integer',
        ], [
            'type_document_id.required' => "Choisissez un Type",
            'cote.required' => 'La cote  est obligatoire',
            'cote.unique' => 'Cette cote a déjà été utilisée',
            'theme.required' => 'Le thème  est obligatoire',
            'auteur.required' => 'Le nom de l\'auteur est obligatoire',
            'encadreur.required' => 'Le nom de l\'encadreur est obligatoire',
            'annee.required' => 'L\' année  est obligatoire',
            'annee.regex' => 'L\' année doit suivre le format XXXX-YYYY',
            'exemplaire.required' => 'Indiquez le nombre d\'exemplaire',
        ]);

        $pdfPath = $document->pdf;

        if (!$request->hasFile('pdf') && $document->pdf) {
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

            $filename = $validatedData['cote'] . 'nouveau_nom.pdf'; // Remplacez 'nouveau_nom' par le nom souhaité

            // Vérifier les erreurs de téléchargement du fichier PDF
            if ($pdf->isValid()) {
                // Stocker le nouveau fichier PDF avec le nom personnalisé
                $pdfPath = $pdf->storeAs('public/memoires_theses', $filename);
            } else {
                // Gérer les erreurs de téléchargement du fichier
                return redirect()->back()->withErrors(['pdf' => 'Une erreur s\'est produite lors du téléchargement du fichier PDF.']);
            }
        }

        $document->update([
            'type_document_id' => $validatedData['type_document_id'],
            'cote' => $validatedData['cote'],
            'auteur' => $validatedData['auteur'],
            'encadreur' => $validatedData['encadreur'],
            'theme' => $validatedData['theme'],
            'annee' => $validatedData['annee'],
            'exemplaire' => $validatedData['exemplaire'],
            'option_id' => $validatedData['option_id'],
            'updated_at' => now(),
            'pdf' => $pdfPath,
        ]);

        return redirect()->route('memoires_theses.type_index', ['type' => $validatedData['type_document_id']])->with('success', 'Le Mémoire a été modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $memoireThese = MemoireThese::findOrFail($id);
        $type_document = $memoireThese->type_document_id;
        Storage::delete($memoireThese->pdf);
        $memoireThese->delete();
        return redirect()->route('memoires_theses.type_index', ['type' => $type_document]);
    }
}
