<nav class="navbar">
    <div class="container">
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Accueil</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Catégories <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chiens']) }}">Pour Chiens</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chats']) }}">Pour Chats</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'oiseaux']) }}">Pour Oiseaux</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'rongeurs']) }}">Pour Rongeurs</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'poissons']) }}">Pour Poissons</a></li>
                </ul>
            </li>
            
            @auth
                @if(Auth::user()->email === 'admin@petshop.com')
                    <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a></li>
                    <li><a href="{{ route('produits.create.public') }}" class="{{ request()->is('ajouter-produit') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> Ajouter Produit
                    </a></li>
                @endif
                <li><a href="{{ route('produits.soldes') }}" class="{{ request()->is('soldes') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Produits en Solde
                </a></li>
            @else
                <li><a href="{{ route('produits.index') }}" class="{{ request()->is('produits') ? 'active' : '' }}">Produits</a></li>
            @endauth
            
            <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">À Propos</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        
        <div class="nav-auth">
            @guest
                <a href="{{ route('login') }}" class="btn-outline">Connexion</a>
                <a href="{{ route('register') }}" class="btn-primary">Inscription</a>
            @else
                <a href="{{ route('cart.index') }}" class="cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">{{ request()->cookie('cart') ? count(json_decode(request()->cookie('cart'), true)) : 0 }}</span>
                </a>
                
                <div class="user-menu dropdown">
                    <a href="#" class="dropdown-toggle user-info">
                        <i class="fas fa-user-circle"></i>
                        {{ Auth::user()->name }}
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i> Mon Panier</a></li>
                        <li><a href="{{ route('produits.soldes') }}"><i class="fas fa-tags"></i> Produits en Solde</a></li>
                        @if(Auth::user()->email === 'admin@petshop.com')
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                            <li><a href="{{ route('produits.create.public') }}"><i class="fas fa-plus-circle"></i> Ajouter un produit</a></li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
        
        <style>
        .cart-link {
            position: relative;
            color: #4CAF50;
            font-size: 1.2em;
            margin-right: 15px;
            text-decoration: none;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.8em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .cart-link:hover {
            color: #45a049;
        }
        </style>
        
        <div class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>