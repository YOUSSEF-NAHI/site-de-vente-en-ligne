@extends('layouts.front.app')

@section('links')
    
@endsection

@section('style')
    <!-- Styles -->
    <link href="{{ asset('/css/front/style.css') }}" rel="stylesheet">
@endsection

@section('content')


<section class="products" id="products" style="margin-top: 50px">

    <h1 class="heading"> Nos <span>produits</span> </h1>

    @foreach ($produits->chunk(3) as $chunk)
        <section class="categories" id="categories">
            <div class="box-container product-slider">
                @foreach ($chunk as $produit)
                    <div class="box">
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
        </section>
@endforeach
{{ $produits->links() }}

</section>

@endsection

@section('script')
    <!-- Most modern mobile touch slider and framework with hardware accelerated transitions -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('/js/front/script.js') }}" defer></script>
@endsection