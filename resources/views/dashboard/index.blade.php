@extends('layout.app')

@section('content')
<div class="container">
    <div class="dashboard-header">
        <h1>Espace Admin</h1>
        <p>Bienvenue, {{ $user->name }} !</p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $produitsEnSolde }}</h3>
                <p>Produits en solde</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalProduits }}</h3>
                <p>Total produits</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-list"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $categories->count() }}</h3>
                <p>Catégories</p>
            </div>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="section-header">
            <h2>Gestion des Produits</h2>
            <a href="{{ route('admin.produits.create') }}" class="btn-primary">Ajouter un produit</a>
        </div>
        
        <div class="products-table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td class="product-image-cell">
                                @if($produit->image)
                                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="product-thumb">
                                @else
                                    <div class="no-image-thumb"><i class="fas fa-image"></i></div>
                                @endif
                            </td>
                            <td class="product-info-cell">
                                <div class="product-name">{{ $produit->nom }}</div>
                                <div class="product-description">{{ Str::limit($produit->description, 80) }}</div>
                            </td>
                            <td class="category-cell">
                                <span class="category-badge">{{ ucfirst($produit->categorie) }}</span>
                            </td>
                            <td class="price-cell">
                                <div class="price">{{ number_format($produit->prix, 2, ',', ' ') }}DH</div>
                                @if($produit->en_solde)
                                    <span class="sale-badge">SOLDE</span>
                                @endif
                            </td>
                            <td class="stock-cell">
                                @if($produit->en_stock && $produit->quantite > 0)
                                    <span class="in-stock">{{ $produit->quantite }} en stock</span>
                                @else
                                    <span class="out-of-stock">Rupture</span>
                                @endif
                            </td>
                            <td class="actions-cell">
                                <div class="action-buttons">
                                    <a href="{{ route('produits.show', $produit->id) }}" class="btn-action btn-view" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.produits.edit', $produit->id) }}" class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.produits.destroy', $produit->id) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-info">
            @if($produits->total() > 0)
                <p>Affichage <strong>{{ $produits->firstItem() }}</strong>-<strong>{{ $produits->lastItem() }}</strong> sur <strong>{{ $produits->total() }}</strong> produits</p>
            @endif
        </div>
        
        <div class="pagination-wrapper">
            @if($produits->hasPages())
                {{ $produits->links('pagination.custom') }}
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.dashboard-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 0;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border-radius: 10px;
}

.dashboard-header h1 {
    margin-bottom: 10px;
    font-size: 2.5rem;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 20px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-info h3 {
    font-size: 2rem;
    margin-bottom: 5px;
    color: var(--primary-color);
}

.stat-info p {
    color: #666;
    margin: 0;
}

.dashboard-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.section-header h2 {
    color: var(--primary-color);
    margin: 0;
}

.sale-product {
    position: relative;
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
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #ddd;
}

.products-table-container {
    overflow-x: auto;
    margin-bottom: 30px;
}

.products-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.products-table th {
    background: var(--primary-color);
    color: white;
    padding: 15px 10px;
    text-align: left;
    font-weight: 600;
    font-size: 0.9rem;
}

.products-table td {
    padding: 15px 10px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
}

.products-table tr:hover {
    background-color: #f8f9fa;
}

.product-image-cell {
    width: 80px;
}

.product-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.no-image-thumb {
    width: 60px;
    height: 60px;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #6c757d;
}

.product-info-cell {
    min-width: 200px;
}

.product-name {
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 5px;
}

.product-description {
    color: #666;
    font-size: 0.9rem;
}

.category-cell {
    width: 120px;
}

.category-badge {
    background: var(--light-gray);
    color: var(--primary-color);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.price-cell {
    width: 120px;
    text-align: center;
}

.price {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary-color);
}

.stock-cell {
    width: 120px;
    text-align: center;
}

.in-stock {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
}

.out-of-stock {
    color: #dc3545;
    font-weight: 600;
    font-size: 0.9rem;
}

.actions-cell {
    width: 120px;
}

.action-buttons {
    display: flex;
    gap: 5px;
    justify-content: center;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.8rem;
}

.btn-view {
    background: #6c757d;
    color: white;
}

.btn-edit {
    background: var(--primary-color);
    color: white;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.pagination-info {
    text-align: center;
    margin: 30px 0 20px 0;
    color: #666;
}

.pagination-info p {
    margin: 0;
    font-size: 0.9rem;
}

.pagination-wrapper {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

/* Styles pour la pagination */
.pagination-wrapper nav {
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 5px;
}

.pagination-wrapper .page-item {
    margin: 0;
}

.pagination-wrapper .page-link {
    display: block;
    padding: 10px 15px;
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    color: var(--primary-color);
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.pagination-wrapper .page-link:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-1px);
}

.pagination-wrapper .page-item.active .page-link {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-wrapper .page-item.disabled .page-link {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
    border-color: #dee2e6;
}

.pagination-wrapper .page-item.disabled .page-link:hover {
    background-color: #f8f9fa;
    color: #6c757d;
    transform: none;
}

/* Styles pour la pagination par défaut de Laravel */
.pagination-wrapper nav[role="navigation"] {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.pagination-wrapper nav[role="navigation"] a,
.pagination-wrapper nav[role="navigation"] span {
    display: inline-block;
    padding: 8px 12px;
    background-color: white;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    color: var(--primary-color);
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    min-width: 40px;
    text-align: center;
}

.pagination-wrapper nav[role="navigation"] a:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-1px);
}

.pagination-wrapper nav[role="navigation"] span[aria-current="page"] {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-wrapper nav[role="navigation"] span[aria-disabled="true"] {
    background-color: #f8f9fa;
    color: #6c757d;
    cursor: not-allowed;
    border-color: #dee2e6;
}
</style>
@endpush