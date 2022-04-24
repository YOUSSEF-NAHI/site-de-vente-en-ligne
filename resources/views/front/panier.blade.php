@extends('layouts.front.app')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

@endsection
@section('content')

<div class="container" style="margin-top:150px; margin-bottom:150px;">
    @include('front.includes.alerts.success')
    @include('front.includes.alerts.errors')
    
    @if ($userPanier)
        @if ($userPanier->produits->count()>0)   
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
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userPanier->produits as $produit )
                            <tr>
                                <th scope="row" class="text-center"> {{$loop->index+1}} </th>
                                <td class="text-center">
                                    <img src="{{asset($produit->image)}}" alt="" style="max-width:50px;">
                                </td>
                                <td class="text-center">
                                    {{ $produit->sousCategorie->name }}
                                </td>
                                <td class="text-center">
                                        
                                    @if ($produit->demande->quantite < 2 )
                                        <a href="#" class="btn disabled " ><i class="fas fa-minus-square"></i></a>
                                    @else
                                        <a href="{{ route('panier.diminuerProduit',$produit->id)}}" class="btn text-primary"><i class="fas fa-minus-square"></i></a>
                                    @endif
                                    
                                    {{ $produit->demande->quantite }} 
                                
                                    <a href="{{ route('panier.augmenterProduit',$produit->id)}}" class="btn text-danger"><i class="fas fa-plus-square"></i></a>
                                </td>
                                <td class="text-center"> {{ $produit->prix }} </td>
                                <td class="text-center"> {{ $produit->demande->prixTotal }} </td>
                                <td class="text-center"> <a href="{{ route('panier.supprimerProduct',$produit->id)}}" class="btn btn-danger">delete <i class="fas fa-trash-alt"></i></a></td>
                            </tr>  
                        @endforeach

                        <tr class="table-primary">
                            <td colspan="4" style="font-weight: bold">Prix Total</td>
                            <td style="font-weight: bold" class="text-center "> {{ $userPanier->prixTotal }} </td>
                        </tr>
            
                    </tbody>
                </table>
            </div>
            
            <div class="text-center mt-3">
                <a href="{{ route('commander')}}" class="btn btn-success" style="width: 200px">Checkout</a>
            </div> 
        @else
            <h1 class="text-center" style="padding-top: 10%">votre panier est vide</h1>
            <div class="text-center">
                <a href="{{ route('index')}}" class="btn btn-success" style="width: 200px">aller à la page d'acceuil</a>
            </div>
        @endif

    @else
        <h1 class="text-center" style="padding-top: 10%">votre panier est vide</h1>
        <div class="text-center">
            <a href="{{ route('index')}}" class="btn btn-success" style="width: 200px">aller à la page d'acceuil</a>
        </div>
    @endif

</div>
    
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@endsection