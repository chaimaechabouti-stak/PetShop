<header class="header">
    <div class="container">
        <div class="logo">
            <i class="fas fa-paw"></i>
            <h1>PetShop</h1>
        </div>
        
        <div class="header-nav-links">
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('nav.home') }}</a>
            
            <div class="dropdown">
                <a href="#" class="dropdown-toggle">{{ __('nav.categories') }} <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chiens']) }}">{{ __('nav.categories_list.dogs') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chats']) }}">{{ __('nav.categories_list.cats') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'oiseaux']) }}">{{ __('nav.categories_list.birds') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'rongeurs']) }}">{{ __('nav.categories_list.rodents') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'poissons']) }}">{{ __('nav.categories_list.fish') }}</a></li>
                </ul>
            </div>
            
            @auth
                @if(Auth::user()->email === 'admin@petshop.com')
                    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">{{ __('nav.dashboard') }}</a>
                    <a href="{{ route('produits.create.public') }}" class="{{ request()->is('ajouter-produit') ? 'active' : '' }}">{{ __('nav.add_product') }}</a>
                @endif
                <a href="{{ route('produits.soldes') }}" class="{{ request()->is('soldes') ? 'active' : '' }}">{{ __('nav.sales') }}</a>
            @else
                <a href="{{ route('produits.index') }}" class="{{ request()->is('produits') ? 'active' : '' }}">{{ __('nav.products') }}</a>
            @endauth
            
            <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">{{ __('nav.about') }}</a>
            <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">{{ __('nav.contact') }}</a>
        </div>
        
        <div class="header-actions">
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">
                    FR
                </a>
                <span>|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
                    EN
                </a>
                <span>|</span>
                <a href="{{ route('lang.switch', 'ar') }}" class="{{ app()->getLocale() == 'ar' ? 'active' : '' }}">
                    AR
                </a>
            </div>
            
            @guest
                <a href="{{ route('login') }}" class="btn-outline">{{ __('nav.login') }}</a>
                <a href="{{ route('register') }}" class="btn-primary">{{ __('nav.register') }}</a>
            @else
                <a href="{{ route('cart.index') }}" class="cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    @php
                        $cart = session('cart', []);
                        $totalItems = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    <span class="cart-count">{{ $totalItems }}</span>
                </a>
                
                <div class="user-menu dropdown">
                    <a href="#" class="dropdown-toggle user-info">
                        <i class="fas fa-user-circle"></i>
                        {{ Auth::user()->name }}
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i> {{ __('nav.my_cart') }}</a></li>
                        <li><a href="{{ route('produits.soldes') }}"><i class="fas fa-tags"></i> {{ __('nav.sales') }}</a></li>
                        @if(Auth::user()->email === 'admin@petshop.com')
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ __('nav.dashboard_admin') }}</a></li>
                            <li><a href="{{ route('produits.create.public') }}"><i class="fas fa-plus-circle"></i> {{ __('nav.add_a_product') }}</a></li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('nav.logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
    
    <style>
    .header .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 30px;
    }
    
    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    
    .logo i {
        font-size: 2em;
        color: #4CAF50;
    }
    
    .logo h1 {
        margin: 0;
        font-size: 1.8em;
        color: #333;
    }
    
    .header-nav-links {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
        justify-content: center;
    }
    
    .header-nav-links > a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .header-nav-links > a:hover,
    .header-nav-links > a.active {
        color: #4CAF50;
        background: #f0f0f0;
    }
    
    .header-nav-links .dropdown {
        position: relative;
    }
    
    .header-nav-links .dropdown-toggle {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .header-nav-links .dropdown:hover .dropdown-toggle {
        color: #4CAF50;
        background: #f0f0f0;
    }
    
    .header-nav-links .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 4px;
        padding: 10px 0;
        min-width: 200px;
        z-index: 1000;
    }
    
    .header-nav-links .dropdown:hover .dropdown-menu {
        display: block;
    }
    
    .header-nav-links .dropdown-menu li {
        list-style: none;
    }
    
    .header-nav-links .dropdown-menu li a {
        display: block;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .header-nav-links .dropdown-menu li a:hover {
        background: #f0f0f0;
        color: #4CAF50;
    }
    
    .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-shrink: 0;
    }
    
    .lang-switcher {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .lang-switcher a {
        color: #666;
        text-decoration: none;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .lang-switcher a.active {
        color: #4CAF50;
        background: #f0f0f0;
    }
    
    .lang-switcher a:hover {
        color: #4CAF50;
    }
    
    .lang-switcher span {
        color: #ccc;
    }
    
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
    
    .btn-outline {
        padding: 8px 16px;
        border: 2px solid #4CAF50;
        background: transparent;
        color: #4CAF50;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-outline:hover {
        background: #4CAF50;
        color: white;
    }
    
    .btn-primary {
        padding: 8px 16px;
        border: 2px solid #4CAF50;
        background: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: #45a049;
        border-color: #45a049;
    }
    
    .user-menu {
        position: relative;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .user-info:hover {
        background: #45a049;
    }
    
    .user-menu .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 4px;
        padding: 10px 0;
        min-width: 200px;
        z-index: 1000;
        margin-top: 5px;
    }
    
    .user-menu:hover .dropdown-menu {
        display: block;
    }
    
    .user-menu .dropdown-menu li {
        list-style: none;
    }
    
    .user-menu .dropdown-menu li a {
        display: block;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .user-menu .dropdown-menu li a:hover {
        background: #f0f0f0;
        color: #4CAF50;
    }
    
    .user-menu .dropdown-menu .divider {
        height: 1px;
        background: #eee;
        margin: 5px 0;
    }
    
    .logout-btn {
        width: 100%;
        text-align: left;
        padding: 10px 20px;
        background: none;
        border: none;
        color: #333;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .logout-btn:hover {
        background: #f0f0f0;
        color: #dc3545;
    }
    </style>
</header>