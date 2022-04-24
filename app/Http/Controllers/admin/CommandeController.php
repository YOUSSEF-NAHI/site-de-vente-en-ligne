<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::orderBy('id','desc')->paginate(10);;
        return view('admin.commandes.index', compact('commandes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::find($id);
        if($commande){
            $client = $commande->user;
            $produits = $commande->produits;
            return view('admin.commandes.show', compact('commande', 'client','produits'));
        }
        return redirect()->route('admin.commandes')->with(['error' => 'commande non trouvé']);
        

    }


    public function sort($status)
    {
        $commandes = Commande::where('status',$status)->orderBy('id','desc')->paginate(10);
        return view('admin.commandes.index', compact('commandes'));

    }

    public function valider($id)
    {
        $commande = Commande::find($id);
        try {

            DB::beginTransaction();

            if($commande->status==0){
                Commande::where('id',$id)->update([
                    'status' => 1,
                ]);
            }else{
                return redirect()->route('admin.commandes')->with(['success' => 'commande validé']);
            }

            DB::commit();

            return redirect()->route('admin.commandes')->with(['success' => 'commande validé']);

        } catch (\Exception $ex) {
            DB::rollback();
            //return $ex;
            return redirect()->route('admin.commandes')->with(['error' => 'une erreur detecte']);
        }

    }

}
