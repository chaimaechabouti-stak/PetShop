@extends('layout.app')

@section('content')
<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Connexion</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                </div>

                <button type="submit" class="btn-primary">Se connecter</button>
            </form>

            <p class="auth-link">
                Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
    padding: 40px 0;
}

.auth-card {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

.auth-card h2 {
    text-align: center;
    margin-bottom: 30px;
    color: var(--primary-color);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
}

.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: normal;
}

.auth-link {
    text-align: center;
    margin-top: 20px;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
@endpush