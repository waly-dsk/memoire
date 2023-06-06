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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('suggestion', [\App\Http\Controllers\SuggestionController::class, 'index'])->name('suggestion.index');
Route::get('suggestion/create', [\App\Http\Controllers\SuggestionController::class, 'create'])->name('suggestion.create');
Route::post('suggestion', [\App\Http\Controllers\SuggestionController::class, 'store'])->name('suggestion.store');
Route::delete('suggestion/{id}', [\App\Http\Controllers\SuggestionController::class, 'destroy'])->name('suggestion.destroy');

Route::get('/non_admin', [\App\Http\Controllers\HomeController::class, 'non_admin'])->name('non_admin');
Route::get('/get_options/{entiteId}', [\App\Http\Controllers\OptionController::class, 'get_options'])->name('get_options');

Route::get('memoires', [\App\Http\Controllers\MemoireTheseController::class, 'index'])->name('memoires.index');
Route::get('memoires/{id}', [\App\Http\Controllers\MemoireTheseController::class, 'show'])->name('memoires.show');

Route::middleware('auth')->group(function () {
    Route::resource('abonne', \App\Http\Controllers\AbonneController::class)->except('show');
    Route::resource('memoire', \App\Http\Controllers\MemoireTheseController::class);
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', \App\Http\Controllers\UserController::class)->except('show');
});
