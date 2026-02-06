@extends('layout.app')

@section('content')
<section class="success-page">
    <div class="container">
        <div class="success-content">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1>Paiement réussi !</h1>
            <p>Votre commande a été traitée avec succès.</p>
            
            <div class="success-details">
                <h3>Que se passe-t-il maintenant ?</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> Vous recevrez un email de confirmation</li>
                    <li><i class="fas fa-truck"></i> Votre commande sera préparée sous 24h</li>
                    <li><i class="fas fa-phone"></i> Notre équipe vous contactera si nécessaire</li>
                </ul>
            </div>
            
            <div class="success-actions">
                <a href="{{ route('produits.index') }}" class="btn-primary">
                    <i class="fas fa-shopping-bag"></i> Continuer mes achats
                </a>
                
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    <i class="fas fa-user"></i> Mon compte
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.success-page {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 0;
}

.success-content {
    text-align: center;
    background: white;
    padding: 50px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    max-width: 600px;
}

.success-icon {
    font-size: 4em;
    color: #4CAF50;
    margin-bottom: 20px;
}

.success-content h1 {
    color: #4CAF50;
    margin-bottom: 10px;
}

.success-content p {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 30px;
}

.success-details {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
    text-align: left;
}

.success-details h3 {
    margin-bottom: 15px;
    color: #333;
}

.success-details ul {
    list-style: none;
    padding: 0;
}

.success-details li {
    padding: 8px 0;
    color: #666;
}

.success-details i {
    color: #4CAF50;
    margin-right: 10px;
    width: 20px;
}

.success-actions {
    margin-top: 30px;
}

.btn-primary, .btn-secondary {
    display: inline-block;
    padding: 12px 25px;
    margin: 0 10px;
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
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .success-content {
        padding: 30px 20px;
        margin: 0 20px;
    }
    
    .btn-primary, .btn-secondary {
        display: block;
        margin: 10px 0;
    }
}
</style>
@endsection