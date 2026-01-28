@extends('layout.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Exemple SQL Natif - {{ ucfirst($categorie_selected) }}</h1>
            <p>Cette page utilise DB::select() avec SQL natif</p>
        </div>
    </section>

    <section class="products-preview">
        <div class="container">
            <h2 class="section-title">Produits (SQL Natif)</h2>
            
            <div class="sql-info">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Note :</strong> Cette page utilise <code>DB::select()</code> pour exécuter une requête SQL brute.
                    Les données sont accessibles via <code>$item->nom</code> (objet stdClass).
                </div>
            </div>
            
            @if(count($produits) > 0)
                <div class="products-grid">
                    @foreach($produits as $item)
                        <div class="product-card">
                            <div class="product-image">
                                <div class="product-category">{{ ucfirst($categorie_selected) }}</div>
                                @if($item->image)
                                    <img src="{{ $item->image }}" alt="{{ $item->nom }}" class="product-img">
                                @else
                                    <div class="product-img-placeholder">
                                        @if($categorie_selected == 'chiens')
                                            <i class="fas fa-dog"></i>
                                        @elseif($categorie_selected == 'chats')
                                            <i class="fas fa-cat"></i>
                                        @else
                                            <i class="fas fa-paw"></i>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="product-info">
                                <h3>{{ $item->nom }}</h3>
                                <p class="product-description">{{ Str::limit($item->description, 80) }}</p>
                                <div class="product-stock">
                                    @if($item->en_stock && $item->quantite > 0)
                                        <span class="in-stock"><i class="fas fa-check-circle"></i> En stock</span>
                                    @else
                                        <span class="out-of-stock"><i class="fas fa-times-circle"></i> Rupture</span>
                                    @endif
                                </div>
                                <p class="product-price">{{ number_format($item->prix, 2, ',', ' ') }}€</p>
                                <a href="{{ route('produits.show', ['id' => $item->id]) }}" class="btn-secondary">Voir détails</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="sql-query">
                    <h4>Requête SQL exécutée :</h4>
                    <pre><code>SELECT * FROM produits WHERE categorie = '{{ $categorie_selected }}'</code></pre>
                    <p><strong>Nombre de résultats :</strong> {{ count($produits) }}</p>
                </div>
            @else
                <div class="no-products">
                    <i class="fas fa-database fa-3x"></i>
                    <h3>Aucun produit trouvé avec SQL natif</h3>
                    <p>La requête SQL n'a retourné aucun résultat.</p>
                </div>
            @endif
            
            <div class="back-to-list">
                <a href="{{ route('produits.categorie', ['cat' => $categorie_selected]) }}" class="btn-primary">
                    <i class="fas fa-arrow-left"></i> Retour à la version Eloquent
                </a>
            </div>
        </div>
    </section>
@endsection