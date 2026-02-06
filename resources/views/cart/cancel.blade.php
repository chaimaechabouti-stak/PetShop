@extends('layout.app')

@section('content')
<section class="cancel-page">
    <div class="container">
        <div class="cancel-content">
            <div class="cancel-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            
            <h1>Paiement annulé</h1>
            <p>Votre paiement a été annulé. Aucun montant n'a été débité.</p>
            
            <div class="cancel-details">
                <h3>Que pouvez-vous faire ?</h3>
                <ul>
                    <li><i class="fas fa-shopping-cart"></i> Vos produits sont toujours dans votre panier</li>
                    <li><i class="fas fa-credit-card"></i> Vous pouvez réessayer le paiement</li>
                    <li><i class="fas fa-phone"></i> Contactez-nous si vous rencontrez des difficultés</li>
                </ul>
            </div>
            
            <div class="cancel-actions">
                <a href="{{ route('cart.index') }}" class="btn-primary">
                    <i class="fas fa-shopping-cart"></i> Retour au panier
                </a>
                
                <a href="{{ route('checkout') }}" class="btn-secondary">
                    <i class="fas fa-credit-card"></i> Réessayer le paiement
                </a>
                
                <a href="{{ route('produits.index') }}" class="btn-tertiary">
                    <i class="fas fa-shopping-bag"></i> Continuer mes achats
                </a>
            </div>
            
            <div class="help-section">
                <p>Besoin d'aide ? <a href="{{ route('contact') }}">Contactez notre support</a></p>
            </div>
        </div>
    </div>
</section>

<style>
.cancel-page {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 0;
}

.cancel-content {
    text-align: center;
    background: white;
    padding: 50px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    max-width: 600px;
}

.cancel-icon {
    font-size: 4em;
    color: #dc3545;
    margin-bottom: 20px;
}

.cancel-content h1 {
    color: #dc3545;
    margin-bottom: 10px;
}

.cancel-content p {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 30px;
}

.cancel-details {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.cancel-details h3 {
    margin-bottom: 15px;
    color: #333;
}

.cancel-details ul {
    list-style: none;
    padding: 0;
}

.cancel-details li {
    padding: 8px 0;
    color: #666;
}

.cancel-details i {
    color: #dc3545;
    margin-right: 10px;
    width: 20px;
}

.cancel-actions {
    margin: 30px 0;
}

.btn-primary, .btn-secondary, .btn-tertiary {
    display: inline-block;
    padding: 12px 25px;
    margin: 5px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #4CAF50;
    color: white;
}

.btn-primary:hover {
    background: #45a049;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #007bff;
    color: white;
}

.btn-secondary:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

.btn-tertiary {
    background: #6c757d;
    color: white;
}

.btn-tertiary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.help-section {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
    color: #666;
}

.help-section a {
    color: #007bff;
    text-decoration: none;
}

.help-section a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .cancel-content {
        padding: 30px 20px;
        margin: 0 20px;
    }
    
    .btn-primary, .btn-secondary, .btn-tertiary {
        display: block;
        margin: 10px 0;
    }
}
</style>
@endsection