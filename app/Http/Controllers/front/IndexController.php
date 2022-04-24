<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Avi;
use App\Models\Categorie;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;
use App\Models\Commande;
use App\Models\SousCategorie;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index','categorie','show');
    }


    public function index() {
        
        // $produit= Produit::all();
        // dd($produit[0]);
        // $produitsHomme = Produit::with(['sousCategorie' => function ($query) {
        //     $query->where('name','homme');
        // }]);
        //return SousCategorie::with('Categorie')->get();
       // return $produitsHomme = Produit::find(1)->SousCategorie->;
        // return $produitsHomme = Produit::with('sousCategorie.Categorie')->get()->where('');

        // dd($produitsHomme);

         $produitsHomme = Produit::whereHas('sousCategorie.Categorie', function ($query) {
            $query->where('name','homme');
        })->orderBy('id','desc')->take(3)->get();

        $produitsFemme = Produit::whereHas('sousCategorie.Categorie', function ($query) {
            $query->where('name','femme');
        })->orderBy('id','desc')->take(3)->get();

        $produitsEnfant = Produit::whereHas('sousCategorie.Categorie', function ($query) {
            $query->where('name','enfant');
        })->orderBy('id','desc')->take(3)->get();

        // if(Auth::user()){
        //     return Auth::user()->panier->produits->count();
        // }

        //collect([1,2,3,4,5,6]);
        return view('front.index', compact('produitsHomme','produitsFemme','produitsEnfant'));
    }

    public function ajouterAvis(Request $request){
        try {
            //return $request;

            DB::beginTransaction();

            $avi = new Avi([
                'contenu' => $request->contenu,
                'user_id' => Auth::user()->id,
                'produit_id' => $request->produit,
            ]);

            $avi->save();

            DB::commit();

            return redirect()->route('produit.show',$request->produit);

        } catch (\Exception $ex) {
            DB::rollback();
            //return $request;
            return $ex;
            return redirect()->route('produit.show',$request->produit)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($id){
        //return Produit::with('avis.user')->find($id);
        $produit = Produit::with('avis.user')->find($id);
        if($produit){
            return view('front.produit', compact('produit'));
        }
    }

    public function categorie($id){

        $categorie = Categorie::find($id);

        if($categorie){

            switch ($categorie->name) {
                case 'homme':
                    $produits = Produit::whereHas('sousCategorie.Categorie', function ($query) {
                        $query->where('name','homme');
                    })->orderBy('id','desc')->paginate(6);
                break;
                case 'femme':
                    $produits = Produit::whereHas('sousCategorie.Categorie', function ($query) {
                        $query->where('name','femme');
                    })->orderBy('id','desc')->paginate(6);
                break;
                case 'enfant':
                    $produits = Produit::whereHas('sousCategorie.Categorie', function ($query) {
                        $query->where('name','enfant');
                    })->orderBy('id','desc')->paginate(6);
                break;
            }
        }

        if($produits){
            return view('front.categorie', compact('produits'));
        }
    }

    public function ajouterAuPanier($idProduit){

        $produit = Produit::find($idProduit);
        $user = User::find(Auth::user()->id);

        if ($produit) { 

            $panier = $user->panier;

            if ($panier) {
                
                // verifier l'existence du produit dans le panier

                $produitPanier = $panier->produits()->find($idProduit);

                if ($produitPanier) {
                    $panier->produits()->updateExistingPivot($idProduit, [
                        'prixTotal' => $produitPanier->demande->prixTotal + $produit->prix,
                        'quantite' => $produitPanier->demande->quantite + 1,
                    ]);
                } 
                else {
                    $panier->produits()->attach($idProduit, [
                        'prixTotal' => $produit->prix,
                        'quantite' => 1,
                    ]);
                }

                //update panier
                $panier->update([
                    'prixTotal' => $panier->prixTotal + $produit->prix,
                ]);

            } 
            else {

                $panier = new panier([
                    'prixTotal' => $produit->prix,
                ]);

                $user->panier()->save($panier);

                $panier->produits()->attach($idProduit, [
                    'prixTotal' => $produit->prix,
                    'quantite' => 1,
                ]);
                  
            }
            return redirect()->route('index')->with(['success' => 'Produit added to panier successfully']);
        }
        return redirect()->route('index')->with(['error' => "Produit dosn't exist"]);
    }

    public function getCommandes() {

        $user = User::find(Auth::user()->id);
        $commandes = $user->commandes;

        //collect([1,2,3,4,5,6]);
        return view('front.commandes', compact('commandes'));
    }
}
