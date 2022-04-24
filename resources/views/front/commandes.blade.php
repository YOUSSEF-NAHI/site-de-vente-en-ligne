@extends('layouts.front.app')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

@endsection
@section('content')

<div class="container" style="margin-top:150px; margin-bottom:150px;">
    
    @if ($userCommandes->count()>0)
        @foreach ($userCommandes as $commande)
            <div class="mt-5 mb-5">
                <h1 style="color: blue">commande {{$loop->index+1}} : {{ $commande->created_at }} </h1>
            </div> 
            @if ($commande->produits->count()>0)   
                <div class="table-responsive">
                    <table class="table  " style="min-width:700px">
                        <thead>
                            <tr class="table-active">
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">image</th>
                                <th scope="col" class="text-center">Nom</th>
                                <th scope="col" class="text-center">Quantite</th>
                                <th scope="col" class="text-center">Prix</th>
                                <th scope="col" class="text-center">Prix Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commande->produits as $produit )
                                <tr>
                                    <th scope="row" class="text-center"> {{$loop->index+1}} </th>
                                    <td class="text-center" >
                                        <img src="{{asset($produit->image)}}" alt="" style="max-width:50px;">
                                    </td>
                                    <td class="text-center">
                                        {{ $produit->sousCategorie->name }}
                                    </td>
                                    <td class="text-center">
 
                                        {{ $produit->LigneCommande->quantite }} 
                                    
                                       
                                    </td>
                                    <td class="text-center"> {{ $produit->prix }} </td>
                                    <td class="text-center"> {{ $produit->LigneCommande->prixTotal }} </td>
                                </tr>  
                            @endforeach

                            <tr class="table-primary">
                                <td colspan="4" style="font-weight: bold">Prix Total</td>
                                <td style="font-weight: bold" class="text-center "> {{ $commande->prixTotal }} </td>
                            </tr>
                
                        </tbody>
                    </table>
                </div>
            @else
                <h1 class="text-center" style="padding-top: 10%">vous n'avez pas de commande</h1>
                <div class="text-center">
                    <a href="{{ route('index')}}" class="btn btn-success" style="width: 200px">go to products page</a>
                </div>
            @endif 
        @endforeach
        

    @else
        <h1 class="text-center" style="padding-top: 10%">vous n'avez pas de commande</h1>
        <div class="text-center">
            <a href="{{ route('index')}}" class="btn btn-success" style="width: 200px">go to products page</a>
        </div>
    @endif

</div>
    
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@endsection