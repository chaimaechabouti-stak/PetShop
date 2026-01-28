@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                @if(isset($categorie_selected))
                    <h2>Produits pour {{ ucfirst($categorie_selected) }}</h2>
                    <p>Découvrez notre sélection premium pour le bien-être de vos compagnons {{ $categorie_selected }}</p>
                @elseif(isset($search_query))
                    <h2>Résultats pour "{{ $search_query }}"</h2>
                    <p>{{ $produits->total() }} produit(s) trouvé(s)</p>
                @else
                    <h2>Bienvenue chez PetShop</h2>
                    <p>Des aliments sains, naturels et équilibrés pour la santé et le bien-être de vos compagnons</p>
                @endif
                
            </div>
            <div class="hero-image">
                <div class="pet-illustration">
                    @if(isset($categorie_selected))
                        @if($categorie_selected == 'chiens')
                            <i class="fas fa-dog"></i>
                        @elseif($categorie_selected == 'chats')
                            <i class="fas fa-cat"></i>
                        @elseif($categorie_selected == 'oiseaux')
                            <i class="fas fa-dove"></i>
                        @elseif($categorie_selected == 'rongeurs')
                            <i class="fas fa-paw"></i>
                        @elseif($categorie_selected == 'poissons')
                            <i class="fas fa-fish"></i>
                        @else
                            <i class="fas fa-paw"></i>
                        @endif
                    @else
                        <i class="fas fa-dog"></i>
                        <i class="fas fa-cat"></i>
                        <i class="fas fa-dove"></i>
                    @endif
                </div>
            </div>
        </div>
    </section>

    
    <!-- Produits Section -->
    <section class="products-preview">
        <div class="container">
            @if(isset($categorie_selected))
                <h2 class="section-title">Produits pour {{ ucfirst($categorie_selected) }}</h2>
            @elseif(isset($search_query))
                <h2 class="section-title">Résultats de recherche</h2>
            @else
                <h2 class="section-title">Nos Produits</h2>
            @endif
            
            {{-- Information sur la pagination --}}
            <div class="pagination-top">
                @if($produits->total() > 0)
                    <p class="showing-results">
                        Affichage <strong>{{ $produits->firstItem() }}</strong>-<strong>{{ $produits->lastItem() }}</strong> 
                        sur <strong>{{ $produits->total() }}</strong> produits
                    </p>
                @endif
            </div>
            
            @if($produits->count() > 0)
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
                                            <i class="fas fa-paw"></i>
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
                                        <span class="out-of-stock"><i class="fas fa-times-circle"></i> Rupture de stock</span>
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
                    {{-- Utilisation de la pagination personnalisée --}}
                    {{ $produits->links('vendor.pagination.custom') }}
                </div>
            @else
                <div class="no-products">
                    <i class="fas fa-search fa-3x"></i>
                    <h3>Aucun produit trouvé</h3>
                    <p>Essayez avec d'autres termes de recherche ou parcourez nos catégories.</p>
                    <a href="{{ route('produits.index') }}" class="btn-primary">Voir tous les produits</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    @if(!isset($categorie_selected) && !isset($search_query))
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
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Livraison Rapide</h3>
                    <p>Livraison gratuite à partir de 50€ d'achat</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Éthique & Durable</h3>
                    <p>Emballages recyclables et engagement envers le bien-être animal</p>
                </div>
            </div>
        </div>
    </section>-->
    @endif
@endsection

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div style="position: relative; margin: 15% auto; padding: 20px; width: 300px; background-color: white; border-radius: 8px;">
        <h5>Confirmer la suppression</h5>
        <p>Êtes-vous sûr de vouloir supprimer le produit <strong id="productName"></strong> ?</p>
        <p style="color: red;">Cette action est irréversible.</p>
        <div style="text-align: right; margin-top: 20px;">
            <button type="button" class="btn-secondary" onclick="closeModal()">Annuler</button>
            <form id="deleteForm" method="POST" style="display: inline; margin-left: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(productId, productName) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('deleteForm').action = '/admin/produits/' + productId;
    document.getElementById('deleteModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>