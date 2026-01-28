@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>PetShop - Animalerie en ligne</h2>
                <p>Les meilleurs produits pour le bien-être de vos animaux de compagnie</p>
                <div class="hero-actions">
                    
                </div>
            </div>
            <div class="hero-image">
                <div class="pet-illustration">
                    <i class="fas fa-dog"></i>
                    <i class="fas fa-cat"></i>
                    <i class="fas fa-paw"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Catégories Section -->
    <section class="categories">
        <div class="container">
            <h2 class="section-title">Nos Catégories</h2>
            <div class="categories-grid">
                @if(isset($categories))
                    @foreach($categories as $categorie)
                        <a href="{{ route('produits.categorie', ['cat' => $categorie->categorie]) }}" 
                           class="category-card">
                            <div class="category-icon">
                                @if($categorie->categorie == 'chiens')
                                    <i class="fas fa-dog"></i>
                                @elseif($categorie->categorie == 'chats')
                                    <i class="fas fa-cat"></i>
                                @elseif($categorie->categorie == 'oiseaux')
                                    <i class="fas fa-dove"></i>
                                @elseif($categorie->categorie == 'rongeurs')
                                    <i class="fas fa-paw"></i>
                                @elseif($categorie->categorie == 'poissons')
                                    <i class="fas fa-fish"></i>
                                @else
                                    <i class="fas fa-paw"></i>
                                @endif
                            </div>
                            <h3>{{ ucfirst($categorie->categorie) }}</h3>
                            <p>{{ App\Models\Produit::where('categorie', $categorie->categorie)->count() }} produits</p>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Nouveaux Produits -->
    <section class="new-products">
        <div class="container">
            <h2 class="section-title">Tous nos Produits</h2>
            
            {{-- Information sur la pagination --}}
            <div class="pagination-top">
                @if($produits->total() > 0)
                    <p class="showing-results">
                        Affichage <strong>{{ $produits->firstItem() }}</strong>-<strong>{{ $produits->lastItem() }}</strong> 
                        sur <strong>{{ $produits->total() }}</strong> produits
                    </p>
                @endif
            </div>
            
            <div class="products-grid">
                @foreach($produits as $produit)
                    <div class="product-card">
                        <div class="product-image">
                            <div class="product-category">{{ ucfirst($produit->categorie) }}</div>
                            @if($produit->image)
                                <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="product-img">
                            @else
                                <div class="product-img-placeholder">
                                    @if($produit->categorie == 'chiens')
                                        <i class="fas fa-dog"></i>
                                    @elseif($produit->categorie == 'chats')
                                        <i class="fas fa-cat"></i>
                                    @elseif($produit->categorie == 'oiseaux')
                                        <i class="fas fa-dove"></i>
                                    @elseif($produit->categorie == 'rongeurs')
                                        <i class="fas fa-hamster"></i>
                                    @elseif($produit->categorie == 'poissons')
                                        <i class="fas fa-fish"></i>
                                    @else
                                        <i class="fas fa-paw"></i>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3>{{ $produit->nom }}</h3>
                            <p class="product-description">{{ Str::limit($produit->description, 80) }}</p>
                            <div class="product-stock">
                                @if($produit->en_stock && $produit->quantite > 0)
                                    <span class="in-stock"><i class="fas fa-check-circle"></i> En stock ({{ $produit->quantite }})</span>
                                @else
                                    <span class="out-of-stock"><i class="fas fa-times-circle"></i> Rupture</span>
                                @endif
                            </div>
                            <p class="product-price">{{ number_format($produit->prix, 2, ',', ' ') }}DH</p>
                            <div class="product-actions">
                                <a href="{{ route('produits.show', ['id' => $produit->id]) }}" class="btn-secondary">Voir détails</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Pagination Links --}}
            <div class="pagination-wrapper">
                {{ $produits->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <!--<section class="features">
        <div class="container">
            <h2 class="section-title">Pourquoi choisir PetShop ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>100% Naturel</h3>
                    <p>Des ingrédients naturels, sans conservateurs artificiels ni colorants</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>Qualité Premium</h3>
                    <p>Des produits certifiés par des vétérinaires et nutritionnistes</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3>Cloudinary</h3>
                    <p>Images optimisées et stockées sur Cloudinary pour un chargement rapide</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Communauté</h3>
                    <p>Ajoutez vos propres produits et contribuez à notre boutique communautaire</p>
                </div>
            </div>
        </div>
    </section>-->

    
    
@endsection

@push('styles')
<style>
.hero-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.new-products {
    padding: 80px 0;
    background-color: var(--light-gray);
}

.view-all {
    text-align: center;
    margin-top: 40px;
}

.how-to-add {
    padding: 80px 0;
}

.steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.step {
    text-align: center;
    padding: 30px 20px;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.step-number {
    width: 60px;
    height: 60px;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 auto 20px;
}

.cta-add {
    text-align: center;
    margin-top: 40px;
}

.btn-large {
    padding: 15px 40px;
    font-size: 1.1rem;
}
</style>
@endpush