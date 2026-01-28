@extends('layout.app')

@section('content')
<div class="container">
    <div class="email-form-container">
        <h2>Recommander ce produit</h2>
        
        <div class="product-preview">
            <div class="product-image">
                @if($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}">
                @else
                    <div class="no-image"><i class="fas fa-image"></i></div>
                @endif
            </div>
            <div class="product-info">
                <h3>{{ $produit->nom }}</h3>
                <p class="category">{{ ucfirst($produit->categorie) }}</p>
                <p class="price">{{ number_format($produit->prix, 2, ',', ' ') }}DH</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('produits.sendEmail', $produit->id) }}" class="email-form">
            @csrf
            
            <div class="form-group">
                <label for="sender_name">Votre nom</label>
                <input type="text" id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required>
            </div>

            <div class="form-group">
                <label for="sender_email">Votre email</label>
                <input type="email" id="sender_email" name="sender_email" value="{{ old('sender_email') }}" required>
            </div>

            <div class="form-group">
                <label for="recipient_email">Email du destinataire</label>
                <input type="email" id="recipient_email" name="recipient_email" value="{{ old('recipient_email') }}" required>
            </div>

            <div class="form-group">
                <label for="message">Message personnel (optionnel)</label>
                <textarea id="message" name="message" rows="4" placeholder="Ajoutez un message personnel...">{{ old('message') }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> Envoyer la recommandation
                </button>
                <a href="{{ route('produits.show', $produit->id) }}" class="btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
.email-form-container {
    max-width: 600px;
    margin: 40px auto;
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.email-form-container h2 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 30px;
}

.product-preview {
    display: flex;
    gap: 20px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 30px;
}

.product-preview .product-image {
    width: 80px;
    height: 80px;
}

.product-preview .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.no-image {
    width: 100%;
    height: 100%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #6c757d;
}

.product-info h3 {
    margin: 0 0 5px 0;
    color: var(--dark-color);
}

.product-info .category {
    color: var(--primary-color);
    font-weight: 600;
    margin: 0 0 5px 0;
}

.product-info .price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0;
}

.email-form .form-group {
    margin-bottom: 20px;
}

.email-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: var(--dark-color);
}

.email-form input,
.email-form textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    font-family: inherit;
}

.email-form textarea {
    resize: vertical;
}

.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
@endpush