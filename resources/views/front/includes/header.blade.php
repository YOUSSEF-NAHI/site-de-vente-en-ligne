
<header class="header">

    <a href="{{ route('index') }}" class="logo"> <i class="fa-solid fa-shop"></i> Shopinger </a>

    <nav class="navbar">
        <a href="{{ route('index') }}">Acceuil</a>
        <a href="{{ route('index') }}#products">produits</a>
        <a href="#review">Contactez-Nous</a>
        <!-- <a href="#blogs">Notre histoire</a> -->
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <a href="{{ route('panier') }}" >
            <div class="fas fa-shopping-cart position-relative" id="cart-btn">
                @auth
                    <span class="position-absolute top-0 start-0 translate-middle  badge rounded-pill bg-primary">
                        @if (Auth::user()->panier)
                            {{ Auth::user()->panier->produits->count() }}   
                        @else
                            0
                        @endif
                    </span>  
                @endauth   
            </div>
        </a>
        <div class="fas fa-user" id="login-btn"></div>
    </div>

    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </form>

    @guest
        <form action="{{ route('login') }}" class="login-form">
            @csrf
            <h3>s'inscrire</h3>
            @if (Route::has('register'))
                <p>vous n'avez pas un compte <a href="{{ route('register') }}">creer compte</a></p>
            @endif

            <input type="submit" value="login now" class="btn">
        </form>
    @else
        <form class="login-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <h3>logout now</h3>
            <input type="submit" value="logout now" class="btn">
            <a href="{{ route('commandes') }}" class="btn">mes commandes</a>
        </form>
        
    @endguest

</header>