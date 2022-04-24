<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\PanierController;

use App\Http\Controllers\admin\ProduitController;
use App\Http\Controllers\admin\CommandeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// les routes de la page des produits
 Route::get('/', [IndexController::class, 'index'])->name('index');
 Route::get('/produit/{id}', [IndexController::class, 'show'])->name('produit.show');
 Route::get('/categorie/{id}', [IndexController::class, 'categorie'])->name('produit.categorie');
 Route::get('/ajouter-produit/{idProduit}', [IndexController::class, 'ajouterAuPanier'])->name('ajouterAuPanier');
 Route::post('/produit/avis', [IndexController::class, 'ajouterAvis'])->name('ajouterAvis');

// Route::get('/commande', [IndexController::class, 'getCommandes'])->name('commande ');


// les routes de la page panier
 Route::get('/panier', [PanierController::class, 'index'])->name('panier');
 Route::get('/panier/supprimer-produit/{idProduit}', [PanierController::class, 'supprimerProduit'])->name('panier.supprimerProduct');
 Route::get('/panier/augmenter-produit/{idProduit}', [PanierController::class, 'augmenterProduit'])->name('panier.augmenterProduit');
 Route::get('/panier/diminuer_produit/{idProduit}', [PanierController::class, 'diminuerProduit'])->name('panier.diminuerProduit');
 Route::get('/panier/check-out', [PanierController::class, 'getCheckOut'])->name('getCheckOut');
 Route::get('/panier/commander', [PanierController::class, 'commander'])->name('commander');
 Route::get('/commandes', [PanierController::class, 'commandes'])->name('commandes');
// les routes Admin

Route::get('/admin/login', [LoginController::class, 'getLogin'])->name('get.admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('/admin/save', [LoginController::class, 'save'])->name('admin.save');
Route::get('/admin/logout', [LoginController::class, 'destroy'])->name('admin.logout');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/commandes', [CommandeController::class, 'index'])->name('admin.commandes');
Route::get('/admin/commandes/valide/{status}', [CommandeController::class, 'sort'])->name('admin.commandes.valide');
Route::get('/admin/commandes/{id}', [CommandeController::class, 'show'])->name('admin.commandes.show');
Route::get('/admin/commande/valider/{id}', [CommandeController::class, 'valider'])->name('admin.commandes.valider');

//Route::get('/admin/commande/livrer/{id}', [CommandeController::class, 'delivrer'])->name('admin.commande.delivrer');


Route::get('/admin/produits', [ProduitController::class, 'index'])->name('admin.produits');
//Route::get('/admin/produits/{id}', [ProduitController::class, 'show'])->name('admin.produits.show');
//Route::get('/admin/produits/create', [ProduitController::class, 'create'])->name('admin.produits.create');
Route::post('/admin/produits/store', [ProduitController::class, 'store'])->name('admin.produits.store');
//Route::get('/admin/produits/edit/{id}', [ProduitController::class, 'edit'])->name('admin.produits.edit');
Route::post('/admin/produits/update/{id}', [ProduitController::class, 'update'])->name('admin.produits.update');
Route::post('/admin/produits/delete/{id}', [ProduitController::class, 'destroy'])->name('admin.produits.delete');
Route::post('/admin/produits/delete-groupe', [ProduitController::class, 'delete'])->name('admin.produits.delete.groupe');


