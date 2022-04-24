<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $userPanier = Panier::with('produits.sousCategorie')->where('user_id',Auth::user()->id)->first();
        //return $userPanier->produits[0];
        return view('front.panier', compact('userPanier'));
    }






    public function supprimerProduit($idProduit){
        
        $user = User::find(Auth::user()->id);
        $panier = $user->panier;

        if ($panier) {

            // produit$produit exist in panier or not, if yes update else add to panier
            $produit = $panier->produits()->find($idProduit);

            if ($produit) {

                $panier->update([
                    'prixTotal' => $panier->prixTotal - $produit->demande->prixTotal,
                ]);

                // if($panier->produits()->count()==0){
                //     //$panier->delete();
                // }
                // else{
                //     $panier->produits()->detach($idProduit);
                // }

                if($panier->produits()->count()!==0){
                    $panier->produits()->detach($idProduit);
                }
                
                return redirect()->route('panier')->with(['success' => 'produit deleted from panier successfully']);
            }   
        } 
        return redirect()->route('panier')->with(['error' => "produit dosn't exist"]);
        
    }



    public function augmenterProduit($idProduit){

        $user = User::find(Auth::user()->id);
        $panier = $user->panier;

        if ($panier) {

            // produit exist in cart or not, if yes update else return back with error message
            $produit = $panier->produits()->find($idProduit);

            if ($produit) {

                $panier->update([
                    'prixTotal' => $panier->prixTotal + $produit->prix,
                ]);

                $panier->produits()->updateExistingPivot($idProduit, [
                    'prixTotal' => $produit->demande->prixTotal + $produit->prix,
                    'quantite' => $produit->demande->quantite + 1,
                ]);

                return redirect()->route('panier');

            }
            
        } 
        return redirect()->route('panier')->with(['error' => "produit dosn't exist"]);

    }

    public function diminuerProduit($idProduit){

        $user = User::find(Auth::user()->id);
        $panier = $user->panier;

        if ($panier) {

            // product exist in cart or not, if yes update else return back with error message

            $produit = $panier->produits()->find($idProduit);

            if ($produit && $produit->demande->quantite>1) {

                $panier->update([
                    'prixTotal' => $panier->prixTotal - $produit->prix,
                ]);

                $panier->produits()->updateExistingPivot($idProduit, [
                    'prixTotal' => $produit->demande->prixTotal - $produit->prix,
                    'quantite' => $produit->demande->quantite - 1,
                ]);

            }
            
        } 
        return redirect()->route('panier');
    }

    public function getCheckOut(){

        $user = User::find(Auth::user()->id);
        $panier = $user->panier;

        if (isset($panier) && $panier->produits()->count()>0) {

            return view('front.checkOut', compact('user'));
        } 
        return redirect()->route('panier')->with(['error' => 'cart is empty']);

    }

    public function commander(){

        $user = User::find(Auth::user()->id);
        $panier = $user->panier;
        
        //creer commande
        if($panier) {

            $commande = new Commande([
                'prixTotal' => $panier->prixTotal,
            ]);
    
            $user->commandes()->save($commande);
    
            foreach ($panier->produits as $produit) {
    
                $commande->produits()->attach($produit->id, [
                    'prixTotal' => $produit->demande->prixTotal,
                    'quantite' => $produit->demande->quantite,
                ]);
            }
    
            $panier->delete();
            return redirect()->route('panier')->with(['success' => 'la commande a passé avec succé']);
        }
        

    }





    public function commandes() {

        $userCommandes = Commande::with('produits.sousCategorie')->where('user_id',Auth::user()->id)->get();
        
        //dd($userCommandes);
        //return $userPanier->produits[0];
        return view('front.commandes', compact('userCommandes'));
    }


}
