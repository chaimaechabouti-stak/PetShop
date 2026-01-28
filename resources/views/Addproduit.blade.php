@extends('layout.app')
@section('content')
<div class="container mt-5">
    {{-- Inclure le message flash --}}
    @include('incs.flash')

    {{-- Afficher les erreurs de validation pour tous les champs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0" style="background-color:#F7F2E8;">
        <div class="card-header text-center" style="background-color:#8B6B3E; color:white;">
            <h4>Ajouter un nouveau produit</h4>
        </div>

        <div class="card-body">
            {{-- Formulaire pour ajouter un produit --}}
            <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nom du produit --}}
                <div class="mb-3">
                    <label for="nom" class="form-label fw-bold" style="color:#8B6B3E;">Nom du produit</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Pain complet sans gluten">
                    @error('nom')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prix --}}
                <div class="mb-3">
                    <label for="prix" class="form-label fw-bold" style="color:#8B6B3E;">Prix (DH)</label>
                    <input type="number" step="0.01" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" placeholder="45.00">
                    @error('prix')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Catégorie --}}
                <div class="mb-3">
                    <label for="categorie" class="form-label fw-bold" style="color:#8B6B3E;">Catégorie du produit</label>
                    <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie') }}" placeholder="Pains & Viennoiseries">
                    @error('categorie')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label for="image" class="form-label fw-bold" style="color:#8B6B3E;">Image du produit</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="text-center">
                    <button type="submit" class="btn px-4" style="background-color:#D4AF37; color:white;">Ajouter le produit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Inclure les fichiers JavaScript de Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>