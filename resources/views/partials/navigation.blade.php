<nav class="navbar">
    <div class="container">
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('nav.home') }}</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">{{ __('nav.categories') }} <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chiens']) }}">{{ __('nav.categories_list.dogs') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'chats']) }}">{{ __('nav.categories_list.cats') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'oiseaux']) }}">{{ __('nav.categories_list.birds') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'rongeurs']) }}">{{ __('nav.categories_list.rodents') }}</a></li>
                    <li><a href="{{ route('produits.categorie', ['cat' => 'poissons']) }}">{{ __('nav.categories_list.fish') }}</a></li>
                </ul>
            </li>
            
            @auth
                @if(Auth::user()->email === 'admin@petshop.com')
                    <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> {{ __('nav.dashboard') }}
                    </a></li>
                    <li><a href="{{ route('produits.create.public') }}" class="{{ request()->is('ajouter-produit') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> {{ __('nav.add_product') }}
                    </a></li>
                @endif
                <li><a href="{{ route('produits.soldes') }}" class="{{ request()->is('soldes') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> {{ __('nav.sales') }}
                </a></li>
            @else
                <li><a href="{{ route('produits.index') }}" class="{{ request()->is('produits') ? 'active' : '' }}">{{ __('nav.products') }}</a></li>
            @endauth
            
            <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">{{ __('nav.about') }}</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">{{ __('nav.contact') }}</a></li>
        </ul>
        
        <div class="nav-auth">
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
        
        .lang-switcher {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-right: 20px;
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
        </style>
        
        <div class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>