<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//  La route home permet au simple visiteur d'atterir sur la page d'accueil
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// L'agent de la bibliothèque ou meme le Responsable peuvent se connecter et atterir sur cette page.
// Elle présente quelques particularités
Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

/**
 * On gère ici le login et le logout
 */
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

/**
 * Un simple visiteur a les possibilités suivantes
 *      VOIR TOUTES LES SUGGESTIONS
 *      FAIRE DES SUGGESTIONS
 */

Route::get('suggestion_generale', [\App\Http\Controllers\SuggestionGeneraleController::class, 'index'])->name('suggestion_generale.index');
Route::get('suggestion_generale/create', [\App\Http\Controllers\SuggestionGeneraleController::class, 'create'])->name('suggestion_generale.create');
Route::post('suggestion_generale', [\App\Http\Controllers\SuggestionGeneraleController::class, 'store'])->name('suggestion_generale.store');


Route::get('suggestion_ouvrage', [\App\Http\Controllers\SuggestionOuvrageController::class, 'index'])->name('suggestion_ouvrage.index');
Route::get('suggestion_ouvrage/create', [\App\Http\Controllers\SuggestionOuvrageController::class, 'create'])->name('suggestion_ouvrage.create');
Route::post('suggestion_ouvrage', [\App\Http\Controllers\SuggestionOuvrageController::class, 'store'])->name('suggestion_ouvrage.store');

/**
 *      LES ROUTES PARTAGEES PAR UN SIMPLE VISITEUR AVEC LE PERSONNEL
 */
Route::get('memoires_theses/type/{type}', [\App\Http\Controllers\MemoireTheseController::class, 'index'])->name('memoires_theses.type_index');
Route::get('memoires_theses/{id}', [\App\Http\Controllers\MemoireTheseController::class, 'show'])->name('memoires_theses.show');
Route::get('memoires_theses/create/{type}', [\App\Http\Controllers\MemoireTheseController::class, 'create'])->name('memoires_theses.type_create');



Route::get('livre_imprimes', [\App\Http\Controllers\LivreImprimeController::class, 'index'])->name('livre_imprimes.index');
Route::get('livre_imprimes/{id}', [\App\Http\Controllers\LivreImprimeController::class, 'show'])->name('livre_imprimes.show');


/**
 *  FOUILLER LES CATEGORIES DES LIVRES IMPRIMES
 *      Pour chaque catégorie on peut voir ses SUBDIVISIONS
 */
Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('categories/{id}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');


/**
 *  Cette route permet d'interdir aux AGENTS d'avoir les attributions du RESPONSABLE.
 *  Elle répond au middleware ADMIN
 */

Route::get('/non_admin', [\App\Http\Controllers\HomeController::class, 'non_admin'])->name('non_admin');


/**
 *  QUELQUES ROUTES POUR DES REQUETES AJAX
 *
 */
Route::get('/get_options/{entiteId}', [\App\Http\Controllers\AjaxController::class, 'get_options'])->name('get_options');
Route::get('/get_divisions/{categoryId}', [\App\Http\Controllers\AjaxController::class, 'get_divisions'])->name('get_divisions');
Route::get('/get_loges/{rayonId}', [\App\Http\Controllers\AjaxController::class, 'get_loges'])->name('get_loges');
Route::get('/get_memos/{mois}', [\App\Http\Controllers\AjaxController::class, 'get_memos'])->name('get_memos');
Route::get('/get_livres/{mois}', [\App\Http\Controllers\AjaxController::class, 'get_livres'])->name('get_livres');
Route::get('/get_prets/{mois}', [\App\Http\Controllers\AjaxController::class, 'get_prets'])->name('get_prets');


/**
 *  LES CAS D'UTILISATION DES AGENTS DE LA BIBLIOTHEQUE
 *  Il s'agit ici des différentes fonctionnalités qui sont les leurs dans le système
 */
Route::middleware('auth')->group(function () {
    Route::delete('suggestion/{id}', [\App\Http\Controllers\SuggestionController::class, 'destroy'])->name('suggestion.destroy');
    Route::resource('abonne', \App\Http\Controllers\AbonneController::class)->except('show');
    Route::resource('rayon', \App\Http\Controllers\RayonController::class)->except('show');
    Route::resource('memoire_these', \App\Http\Controllers\MemoireTheseController::class)->except(['index', 'create', 'show']);
    Route::resource('livre_imprime', \App\Http\Controllers\LivreImprimeController::class);
    Route::resource('pret', \App\Http\Controllers\PretController::class)->except('destroy');
    Route::get('/pret/{id}/retour', [\App\Http\Controllers\PretController::class, 'pret_retour_create'])->name('pret.retour.create');
    Route::put('/pret/{id}/retour', [\App\Http\Controllers\PretController::class, 'retour_pret'])->name('pret.retour.put');
    Route::resource('consultation_memoire_these', \App\Http\Controllers\ConsultationMemoireController::class)->except(['destroy', 'show', 'index', 'update', 'edit']);
    Route::resource('consultation_livre_imprime', \App\Http\Controllers\ConsultationLivreImprimeController::class)->except(['destroy', 'show', 'index', 'update', 'edit']);
    Route::get('statistiques/consultations/memoires_theses', [\App\Http\Controllers\StatistiquesController::class, 'stats_memoires_theses'])->name('stats_memoires_theses');
    Route::get('statistiques/consultations/livres', [\App\Http\Controllers\StatistiquesController::class, 'stats_livres_imprimes'])->name('stats_livres_imprimes');
    Route::get('statistiques/prets_a_domicile', [\App\Http\Controllers\StatistiquesController::class, 'stats_prets'])->name('stats_prets');
    Route::get('graphes/consultations_memoires_theses', [\App\Http\Controllers\ChartController::class, 'consultations_memoires_theses'])->name('consultations_memoires_theses');
    Route::get('graphes/consultations_livres_imprimes', [\App\Http\Controllers\ChartController::class, 'consultations_livres_imprimes'])->name('consultations_livres_imprimes');
    Route::get('graphes/prets_livres_imprimes', [\App\Http\Controllers\ChartController::class, 'prets_livres_imprimes'])->name('prets_livres_imprimes');
});

/**
 *  L'administrateur
 */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', \App\Http\Controllers\UserController::class)->except('show');
});
