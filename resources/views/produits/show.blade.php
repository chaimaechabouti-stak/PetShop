@extends('layout.app')

@section('content')
    <!-- Product Detail Section -->
    <section class="product-detail">
        <div class="container">
            @include('partials.flash-messages')
            
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Accueil</a> > 
                <a href="{{ route('produits.categorie', ['cat' => $produit->categorie]) }}">{{ ucfirst($produit->categorie) }}</a> > 
                <span>{{ $produit->nom }}</span>
            </div>
            
            <div class="product-detail-grid">
                <div class="product-image-large">
                    @if($produit->image)
                        <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="product-detail-img">
                    @else
                        <div class="image-container">
                            @if($produit->categorie == 'chiens')
                                <i class="fas fa-dog fa-8x"></i>
                            @elseif($produit->categorie == 'chats')
                                <i class="fas fa-cat fa-8x"></i>
                            @elseif($produit->categorie == 'oiseaux')
                                <i class="fas fa-dove fa-8x"></i>
                            @elseif($produit->categorie == 'rongeurs')
                                <i class="fas fa-paw fa-8x"></i>
                            @elseif($produit->categorie == 'poissons')
                                <i class="fas fa-fish fa-8x"></i>
                            @else
                                <i class="fas fa-paw fa-8x"></i>
                            @endif
                        </div>
                    @endif
                </div>
                
                <div class="product-info-detail">
                    <h1>{{ $produit->nom }}</h1>
                    <div class="product-category-badge">
                        <i class="fas fa-tag"></i> {{ ucfirst($produit->categorie) }}
                    </div>
                    
                    <div class="product-price-large">
                        {{ number_format($produit->prix, 2, ',', ' ') }}DH
                    </div>
                    
                    <div class="product-stock-detail">
                        @if($produit->en_stock && $produit->quantite > 0)
                            <span class="in-stock"><i class="fas fa-check-circle"></i> En stock ({{ $produit->quantite }} disponibles)</span>
                        @else
                            <span class="out-of-stock"><i class="fas fa-times-circle"></i> Rupture de stock</span>
                        @endif
                    </div>
                    
                    <div class="product-description-full">
                        <h3>Description</h3>
                        <p>{{ $produit->description }}</p>
                    </div>
                    
                    <div class="product-actions">
                        <div class="quantity-selector">
                            <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                            <input type="number" value="1" min="1" max="{{ $produit->quantite }}" class="qty-input">
                            <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                        </div>
                        <button class="btn-primary add-to-cart-btn" data-product-id="{{ $produit->id }}" 
                                {{ !$produit->en_stock || $produit->quantite <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus"></i> Ajouter au panier
                        </button>
                        <button class="btn-secondary">
                            <i class="fas fa-heart"></i> Ajouter aux favoris
                        </button>
                        <a href="{{ route('produits.email', $produit->id) }}" class="btn-secondary">
                            <i class="fas fa-share"></i> Recommander
                        </a>
                        @auth
                            @if(Auth::user()->email === 'admin@petshop.com')
                                <a href="{{ route('admin.produits.edit', $produit->id) }}" class="btn-primary">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <button type="button" class="btn-danger" onclick="confirmDelete({{ $produit->id }}, '{{ addslashes($produit->nom) }}')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="product-specs">
                        <h3>Caractéristiques</h3>
                        <ul>
                            <li><i class="fas fa-check"></i> Produit 100% naturel</li>
                            <li><i class="fas fa-check"></i> Sans conservateurs artificiels</li>
                            <li><i class="fas fa-check"></i> Formulé par des experts</li>
                            <li><i class="fas fa-check"></i> Emballage recyclable</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Related Products Section -->
    <section class="related-products">
        <div class="container">
            <h2 class="section-title">Produits similaires</h2>
            <div class="products-grid">
                @php
                    $relatedProducts = App\Models\Produit::where('categorie', $produit->categorie)
                        ->where('id', '!=', $produit->id)
                        ->limit(4)
                        ->get();
                @endphp
                
                @if($relatedProducts->count() > 0)
                    @foreach($relatedProducts as $related)
                        <div class="product-card">
                            <div class="product-image">
                                <div class="product-category">{{ ucfirst($related->categorie) }}</div>
                                @if($related->image)
                                    <img src="{{ $related->image }}" alt="{{ $related->nom }}" class="product-img">
                                @else
                                    <div class="product-img-placeholder">
                                        @if($related->categorie == 'chiens')
                                            <i class="fas fa-dog"></i>
                                        @elseif($related->categorie == 'chats')
                                            <i class="fas fa-cat"></i>
                                        @elseif($related->categorie == 'oiseaux')
                                            <i class="fas fa-dove"></i>
                                        @elseif($related->categorie == 'rongeurs')
                                            <i class="fas fa-hamster"></i>
                                        @elseif($related->categorie == 'poissons')
                                            <i class="fas fa-fish"></i>
                                        @else
                                            <i class="fas fa-paw"></i>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h3>{{ $related->nom }}</h3>
                                <p class="product-description">{{ Str::limit($related->description, 80) }}</p>
                                <p class="product-price">{{ number_format($related->prix, 2, ',', ' ') }}DH</p>
                                <a href="{{ route('produits.show', ['id' => $related->id]) }}" class="btn-secondary">Voir détails</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucun produit similaire trouvé.</p>
                @endif
            </div>
        </div>
    </section>
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