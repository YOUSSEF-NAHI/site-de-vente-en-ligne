@extends('layouts.front.app')

@section('links')
    
@endsection

@section('style')
    <!-- Styles -->
    <link href="{{ asset('/css/front/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="home" id="home">

    <div class="content">
        <h3>Des offres <span>spéciales</span> sur tout nos produits</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam libero nostrum veniam facere tempore nisi.</p>
        <a href="#products" class="btn">Acheter</a>
    </div>

</section>

<section class="products" id="products">

    <h1 class="heading"> Nos <span>produits</span> </h1>
    @if($produitsHomme->count()!=0)
        <div class="d-flex justify-content-between p-4" style="background-color: orange; color:white; font-size:16px">
            <div>
                <p class="my-auto ml-4">Hommes</p>
            </div>
            <div class="my-auto mr-4">
                <a href="{{ route('produit.categorie', $produitsHomme[0]->sousCategorie->categorie->id) }}">Voir tout</a>
            </div>
        </div>
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                @foreach ($produitsHomme as $produit)
                        <div class="swiper-slide box">
                            <a href="{{ route('produit.show', $produit->id) }}" style="text-decoration: none">
                                <img src="{{asset($produit->image)}}" alt="">
                                <h3>{{$produit->sousCategorie->name}}</h3>
                                <div class="price"> {{$produit->prix}} DH</div>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </a>
                            <a href="{{ route('ajouterAuPanier', $produit->id) }}" class="btn">Ajouter au panier</a>
                        
                        </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($produitsFemme->count()!=0)
        <div class="d-flex justify-content-between p-4" style="background-color: orange; color:white; font-size:16px">
            <div>
                <p class="my-auto ml-4">Femmes</p>
            </div>
            <div class="my-auto mr-4">
                <a href="{{ route('produit.categorie', $produitsFemme[0]->sousCategorie->categorie->id) }}">Voir tout</a>
            </div>
        </div>
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                @foreach ($produitsFemme as $produit)
                    <div class="swiper-slide box">
                        <a href="{{ route('produit.show', $produit->id) }}" style="text-decoration: none">
                            <img src="{{asset($produit->image)}}" alt="">
                            <h3>{{$produit->sousCategorie->name}}</h3>
                            <div class="price"> {{$produit->prix}} DH</div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </a>
                        <a href="{{ route('ajouterAuPanier', $produit->id) }}" class="btn">Ajouter au panier</a>
                    
                    </div>
                
                @endforeach
            </div>
        </div>
    @endif
    @if($produitsEnfant->count()!=0)
        <div class="d-flex justify-content-between p-4" style="background-color: orange; color:white; font-size:16px">
            <div>
                <p class="my-auto ml-4">Enfants</p>
            </div>
            <div class="my-auto mr-4">
                <a href="{{ route('produit.categorie', $produitsEnfant[0]->sousCategorie->categorie->id) }}">
                    Voir tout
                </a>
            </div>
        </div>
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                @foreach ($produitsEnfant as $produit)
                    <div class="swiper-slide box">
                        <a href="{{ route('produit.show', $produit->id) }}" style="text-decoration: none">
                            <img src="{{asset($produit->image)}}" alt="">
                            <h3>{{$produit->sousCategorie->name}}</h3>
                            <div class="price"> {{$produit->prix}} DH</div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </a>
                        <a href="{{ route('ajouterAuPanier', $produit->id) }}" class="btn">Ajouter au panier</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


</section>

@endsection

@section('script')
    <!-- Most modern mobile touch slider and framework with hardware accelerated transitions -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('/js/front/script.js') }}" defer></script>
@endsection