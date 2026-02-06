@extends('layout.app')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Mon Panier</h1>
        <p>Gérez vos produits sélectionnés</p>
    </div>
</section>

<section class="cart-content">
    <div class="container">
        @if(empty($cart))
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Votre panier est vide</h3>
                <a href="{{ route('produits.index') }}" class="btn-primary">Continuer mes achats</a>
            </div>
        @else
            <div class="cart-items">
                @foreach($cart as $id => $item)
                    <div class="cart-item">
                        <div class="item-image">
                            @if($item['product']->image_url)
                                <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->nom }}">
                            @else
                                <div class="no-image"><i class="fas fa-paw"></i></div>
                            @endif
                        </div>
                        
                        <div class="item-details">
                            <h4>{{ $item['product']->nom }}</h4>
                            <p class="price">{{ number_format($item['product']->prix, 2) }}DH</p>
                        </div>
                        
                        <div class="item-quantity">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" onchange="this.form.submit()">
                            </form>
                        </div>
                        
                        <div class="item-total">
                            {{ number_format($item['product']->prix * $item['quantity'], 2) }}DH
                        </div>
                        
                        <div class="item-actions">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="cart-summary">
                <div class="total">
                    <h3>Total: {{ number_format($total, 2) }}DH</h3>
                </div>
                
                <div class="cart-actions">
                    <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-secondary">Vider le panier</button>
                    </form>
                    
                    <a href="{{ route('checkout') }}" class="btn-primary">Procéder au paiement</a>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.empty-cart {
    text-align: center;
    padding: 50px;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    gap: 20px;
}

.item-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.no-image {
    width: 80px;
    height: 80px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

.item-details {
    flex: 1;
}

.item-quantity input {
    width: 60px;
    padding: 5px;
    text-align: center;
}

.cart-summary {
    background: #f9f9f9;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-primary, .btn-secondary, .btn-danger {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    margin: 0 5px;
}

.btn-primary {
    background: #4CAF50;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-danger {
    background: #dc3545;
    color: white;
}
</style>
@endsection