@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>{{ __('home.hero.title') }}</h2>
                <p>{{ __('home.hero.subtitle') }}</p>
                <a href="#" class="btn-primary">{{ __('home.hero.cta') }}</a>
            </div>
            <div class="hero-image">
                <div class="pet-illustration">
                    <i class="fas fa-dog"></i>
                    <i class="fas fa-cat"></i>
                    <i class="fas fa-fish"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">{{ __('home.features.title') }}</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>{{ __('home.features.natural.title') }}</h3>
                    <p>{{ __('home.features.natural.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>{{ __('home.features.quality.title') }}</h3>
                    <p>{{ __('home.features.quality.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>{{ __('home.features.delivery.title') }}</h3>
                    <p>{{ __('home.features.delivery.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>{{ __('home.features.ethical.title') }}</h3>
                    <p>{{ __('home.features.ethical.description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview -->
    <section class="products-preview">
        <div class="container">
            <h2 class="section-title">{{ __('home.products.title') }}</h2>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image dog-food"></div>
                    <h3>Croquettes Premium Chien</h3>
                    <p class="product-description">Riche en protéines, sans céréales</p>
                    <p class="product-price">24,99€</p>
                    <button class="btn-secondary">{{ __('home.products.add_to_cart') }}</button>
                </div>
                <div class="product-card">
                    <div class="product-image cat-food"></div>
                    <h3>Pâtée Chat Délicieuse</h3>
                    <p class="product-description">Au saumon et légumes frais</p>
                    <p class="product-price">18,99€</p>
                    <button class="btn-secondary">{{ __('home.products.add_to_cart') }}</button>
                </div>
                <div class="product-card">
                    <div class="product-image pet-toy"></div>
                    <h3>Jouet interactif</h3>
                    <p class="product-description">Stimule l'intelligence de votre animal</p>
                    <p class="product-price">12,99€</p>
                    <button class="btn-secondary">{{ __('home.products.add_to_cart') }}</button>
                </div>
                <div class="product-card">
                    <div class="product-image pet-bed"></div>
                    <h3>Panier Douillet</h3>
                    <p class="product-description">Confort optimal pour le repos</p>
                    <p class="product-price">34,99€</p>
                    <button class="btn-secondary">{{ __('home.products.add_to_cart') }}</button>
                </div>
            </div>
        </div>
    </section>
@endsection