<!-- Sidebar  -->
<nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
            @if (Auth::user()->role == "Administrator")
                <p>Admin</p>
                <li class="active">
                    <a href="{{route('admin.produits')}}">Produits</a>
                </li>
            @else
                <p>Gestionnaire des commandes</p>
            @endif
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Commandes</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="{{route('admin.commandes')}}">afficher tous</a>
                    </li>
                    <li>
                        <a href="{{route('admin.commandes.valide',0)}}">commandes non validé</a>
                    </li>
                    <li>
                        <a href="{{route('admin.commandes.valide',1)}}">commandes validé</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{route('admin.logout')}}">logout</a>
            </li>
        </ul>
    </nav>