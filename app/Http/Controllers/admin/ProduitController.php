<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Produit;
use App\Models\SousCategorie;

use Illuminate\Support\Str;

class ProduitController extends Controller
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
        $produits = Produit::with('sousCategorie.Categorie')->paginate(3);
        $categories = Categorie::with('sousCategories')->get();
        return view('admin.produits.index', compact('produits', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // $path = $request->file('image')->store('avatars');
 
        // return $path;
        try {
            //return $request;

            
            $filePath = "";
            if ($request->has('image')) {

                $filePath = "/".$this->uploadImage('produits', $request->file('image'));
            }

            DB::beginTransaction();

            $produit = new Produit([
                'marque' => $request->marque,
                'Qstock' => $request->Qstock,
                'prix' => $request->prix,
                'image' => $filePath,
                'designation' => $request->designation,
                'sous_categorie_id' => $request->sousCategorie,
            ]);

            $produit->save();

            DB::commit();

            return redirect()->route('admin.produits')->with(['success' => 'enregistre avec succé']);

        } catch (\Exception $ex) {
            DB::rollback();
            //return $ex;
            return redirect()->route('admin.produits')->with(['error' => 'une erreur detecte']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //return $request;
            $produit = Produit::find($id);

            if (!$produit)
                return redirect()->route('admin.produits')->with(['error' => "produit n'existe pas"]);

            // update date

            
            $filePath = "";
            if ($request->has('image')) {

                $filePath = "/".$this->uploadImage('produits', $request->file('image'));
            }

            DB::beginTransaction();

            Produit::where('id',$id)->update([
                'marque' => $request->marque,
                'Qstock' => $request->Qstock,
                'prix' => $request->prix,
                'image' => $filePath,
                'designation' => $request->designation,
                'sous_categorie_id' => $request->sousCategorie,
            ]);

            $produit->save();

            DB::commit();

            return redirect()->route('admin.produits')->with(['success' => 'enregistre avec succé']);

        } catch (\Exception $ex) {
            DB::rollback();
           // return $ex;
            return redirect()->route('admin.produits')->with(['error' => 'une erreur detecte']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //return $request;
            $produit = Produit::find($id);

            if (!$produit)
                return redirect()->route('admin.produits')->with(['error' => "produit n'existe pas"]);

            // delete date

            // $image = Str::after($produit->image, '');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $produit->delete();
            return redirect()->route('admin.produits')->with(['success' => 'supprimé avec succé']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.produits')->with(['error' => 'une erreur detecte']);
        }
    }

    public function delete(Request $request)
    {
        try {
           // return $request;
            if (!isset($request->options))
                return redirect()->route('admin.produits')->with(['error' => 'une erreur detecte']);

            Produit::destroy($request->options);
   
            return redirect()->route('admin.produits')->with(['success' => 'supprimé avec succé']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.produits')->with(['error' => 'une erreur detecte']);
        }
    }

    private function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'img/' . $folder . '/' . $filename;
        return $path;
    }
}
