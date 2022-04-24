@extends('layouts.front.app')

@section('links')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('style')
    <!-- Styles -->
    <link href="{{ asset('/css/admin/produits/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/front/detail-style.css') }}" rel="stylesheet">
    
@endsection

@section('content')

<main class="product-detail">
    <div class="details container">
        <div class="left image-container">
          <div class="main">
            <img src="{{asset($produit->image)}}" id="zoom" alt="" />
          </div>
        </div>
        <div class="right">
          <span>{{ $produit->sousCategorie->categorie->name }}/{{ $produit->sousCategorie->name }}</span>
          <h1> {{ $produit->sousCategorie->categorie->name }}’s {{ $produit->sousCategorie->name }}</h1>
          <div class="price"> {{ $produit->prix }} DH</div>
          
          <form class="form">
            <a href="{{ route('ajouterAuPanier', $produit->id) }}" id="checkout_btn" class="btn">Ajouter au panier</a>
          </form>
          <h3>Détail du produit</h3>
      <p>
        {{ $produit->designation }}
      </p>
    </div>
  </div>
</main>
<div class="container mb-5">
  <div class="d-flex justify-content-between p-4" style="background-color: rgb(75, 159, 238); color:white; font-size:16px">
    <div>
        <p class="my-auto ml-4" style="border-radius: ">commentaires</p>
    </div>
    @auth
      <div class="my-auto mr-4">
        <a href="#addComment" data-toggle="modal" 
          style="color: white; background-color:green; padding:5px; border-radius:10px">
          ajouter
        </a>
      </div>
    @endauth
  </div>
  @foreach ($produit->avis->reverse() as $avi)
    <div class="my-3">
      <h4 style="color: indigo">{{ $avi->user->name }}</h4>
      <p>{{ $avi->contenu }}</p>
    </div>
  @endforeach  
</div>
<!-- add Modal HTML -->
<div id="addComment" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('ajouterAvis')}}"
                    method="POST"
                >
                @csrf
        <input type="hidden" name="produit" value="{{ $produit->id }}">
				<div class="modal-header">						
					<h4 class="modal-title">Ajouter commentaire</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
          <div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" 
            value="@auth {{ Auth::user()->name }} @endauth" required>
					</div>						
					<div class="form-group">
						<label>contenu</label>
						<textarea class="form-control" name="contenu" required></textarea>
					</div>									
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
    <!-- Most modern mobile touch slider and framework with hardware accelerated transitions -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Scripts -->
    <script
      src="https://code.jquery.com/jquery-3.4.0.min.js"
      integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('/js/front/zoomsl.min.js') }}" defer></script>
    <script>
        $(function () {
          console.log("hello");
          $("#zoom").imagezoomsl({
            zoomrange: [4, 4],
          });
        });
    </script>
    
@endsection