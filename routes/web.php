<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// les routes de la page des produits
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/ajouter-produit/{idProduit}', [indexController::class, 'addToCart'])->name('addToCart');


// les routes de la page panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier');
Route::get('/panier/supprimer-produit/{idProduit}', [PanierController::class, 'supprimerProduct'])->name('panier.supprimerProduct');
Route::get('/panier/augmenter-produit/{idProduit}', [PanierController::class, 'augmenterProduct'])->name('panier.augmenterProduct');
Route::get('/panier/diminuer_produit/{idProduit}', [PanierController::class, 'diminuerProduct'])->name('panier.diminuerProduct');
Route::get('/panier/check-out', [PanierController::class, 'checkOut'])->name('checkOut');
