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

Route::get('suggestion', [\App\Http\Controllers\SuggestionController::class, 'index'])->name('suggestion.index');
Route::get('suggestion/create', [\App\Http\Controllers\SuggestionController::class, 'create'])->name('suggestion.create');
Route::post('suggestion', [\App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestion.store');

/**
 *      LES ROUTES PARTAGEES PAR UN SIMPLE VISITEUR AVEC LE PERSONNEL
 */
Route::get('memoires', [\App\Http\Controllers\MemoireTheseController::class, 'index'])->name('memoires.index');
Route::get('memoires/{id}', [\App\Http\Controllers\MemoireTheseController::class, 'show'])->name('memoires.show');
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


/**
 *  LES CAS D'UTILISATION DES AGENTS DE LA BIBLIOTHEQUE
 *  Il s'agit ici des différentes fonctionnalités qui sont les leurs dans le système
 */
Route::middleware('auth')->group(function () {
    Route::delete('suggestion/{id}', [\App\Http\Controllers\SuggestionController::class, 'destroy'])->name('suggestion.destroy');
    Route::resource('abonne', \App\Http\Controllers\AbonneController::class)->except('show');
    Route::resource('memoire', \App\Http\Controllers\MemoireTheseController::class);
    Route::resource('livre_imprime', \App\Http\Controllers\LivreImprimeController::class);
    Route::resource('pret', \App\Http\Controllers\PretController::class)->except('destroy');
    Route::get('/pret/{id}/retour', [\App\Http\Controllers\PretController::class, 'pret_retour_create'])->name('pret.retour.create');
    Route::put('/pret/{id}/retour', [\App\Http\Controllers\PretController::class, 'retour_pret'])->name('pret.retour.put');
    Route::resource('consultation_memoire_these', \App\Http\Controllers\ConsultationMemoireController::class)->except('destroy');
});

/**
 *  L'administrateur
 */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', \App\Http\Controllers\UserController::class)->except('show');
});
