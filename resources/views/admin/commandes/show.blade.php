@extends('layouts.admin.app')

@section('links')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('style')
    <!-- Styles -->
    <link href="{{ asset('/css/admin/produits/style.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Client</h2>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th >Name</th>
                        <th >Email</th>
						<th ></th>
					</tr>
				</thead>
				<tbody>
                    <tr>
                        <td>
                            {{ $client->name }}
                        </td>
                        <td>
                            {{ $client->email }}
                        </td>
                    </tr>  
				</tbody>
			</table>
		</div>
	</div>        
</div>


<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Commande</h2>
					</div>
                    @if ($commande->status==0)
                        <div class="col-sm-6">
                            <a href="{{route('admin.commandes.valider', $commande->id )}}" class="btn btn-success"><span>valider</span></a>						
                        </div>        
                    @endif
					
				</div>
			</div>
			<table class="table table-striped table-hover">
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
                    @foreach ($produits as $produit )
                        <tr>
                            <th scope="row" class="text-center"> {{$loop->index+1}} </th>
                            <td class="text-center">
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
	</div>        
</div>


@endsection

@section('script')
<script src="{{ asset('/js/admin/produits/script.js') }}" defer></script>
@endsection
