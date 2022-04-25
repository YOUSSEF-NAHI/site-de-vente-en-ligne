<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Site de vente') }}</title>
   <link href="{{ asset('/css/front/detail-style.css') }}" rel="stylesheet">

</head>
<body>
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
              <h2 style="color: red">Détail du produit</h2>
                <p>
                    {{ $produit->designation }}
                </p>
            </div>
        </div>
    </main>

</body>
</html>