@extends('layout.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-tags"></i> Produits en Solde</h1>
        <p>Découvrez nos meilleures offres à prix réduits</p>
    </div>

    <div class="products-section">
        <div class="products-grid">
            @foreach($produitsEnSolde as $produit)
                <div class="product-card sale-product">
                    <div class="product-image">
                        <div class="sale-badge">SOLDE</div>
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
                        <div class="product-price">
                            <span class="current-price">{{ number_format($produit->prix, 2, ',', ' ') }}DH</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ route('produits.show', ['id' => $produit->id]) }}" class="btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($produitsEnSolde->count() == 0)
            <div class="empty-state">
                <i class="fas fa-tags"></i>
                <h3>Aucun produit en solde</h3>
                <p>Revenez bientôt pour découvrir nos prochaines offres !</p>
                <a href="{{ route('produits.index') }}" class="btn-primary">Voir tous les produits</a>
            </div>
        @endif

        {{-- Pagination --}}
        <div class="pagination-wrapper">
            {{ $produitsEnSolde->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 0;
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-radius: 10px;
}

.page-header h1 {
    margin-bottom: 10px;
    font-size: 2.5rem;
}

.page-header i {
    margin-right: 10px;
}

.products-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.sale-product {
    position: relative;
    border: 2px solid #e74c3c;
}

.sale-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #e74c3c;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8rem;
    font-weight: bold;
    z-index: 2;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #666;
}

.empty-state i {
    font-size: 5rem;
    margin-bottom: 20px;
    color: #e74c3c;
}

.empty-state h3 {
    margin-bottom: 15px;
    color: #333;
}

.empty-state p {
    margin-bottom: 30px;
    font-size: 1.1rem;
}
</style>
@endpush