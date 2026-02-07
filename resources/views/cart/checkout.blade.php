@extends('layout.app')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Finaliser la commande</h1>
        <p>Vérifiez votre commande avant le paiement</p>
    </div>
</section>

<section class="checkout-content">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="checkout-grid">
            <div class="order-summary">
                <h3>Résumé de la commande</h3>
                
                @foreach($cart as $item)
                    @php
                        $product = is_array($item['product']) ? (object)$item['product'] : $item['product'];
                    @endphp
                    <div class="order-item">
                        <span class="item-name">{{ $product->nom }}</span>
                        <span class="item-quantity">x{{ $item['quantity'] }}</span>
                        <span class="item-price">{{ number_format($product->prix * $item['quantity'], 2) }}DH</span>
                    </div>
                @endforeach
                
                <div class="order-total">
                    <strong>Total: {{ number_format($total, 2) }}DH</strong>
                </div>
            </div>
            
            <div class="payment-section">
                <h3>Paiement sécurisé</h3>
                <p>Vous serez redirigé vers Stripe pour effectuer le paiement en toute sécurité.</p>
                
                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-pay">
                        <i class="fas fa-credit-card"></i>
                        Payer {{ number_format($total, 2) }}DH
                    </button>
                </form>
                
                <div class="payment-info">
                    <p><i class="fas fa-shield-alt"></i> Paiement 100% sécurisé</p>
                    <p><i class="fas fa-lock"></i> Vos données sont protégées</p>
                </div>
            </div>
        </div>
        
        <div class="back-to-cart">
            <a href="{{ route('cart.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour au panier
            </a>
        </div>
    </div>
</section>

<style>
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin: 40px 0;
}

.order-summary, .payment-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.order-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.order-total {
    padding: 20px 0;
    font-size: 1.2em;
    text-align: right;
}

.btn-pay {
    width: 100%;
    background: #4CAF50;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 8px;
    font-size: 1.1em;
    cursor: pointer;
    margin: 20px 0;
}

.btn-pay:hover {
    background: #45a049;
}

.payment-info {
    margin-top: 20px;
    color: #666;
}

.payment-info p {
    margin: 10px 0;
}

.back-to-cart {
    text-align: center;
    margin-top: 30px;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.btn-secondary {
    background: #6c757d;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>
@endsection