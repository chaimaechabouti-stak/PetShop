@extends('layout.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Modifier le Produit</h1>
            <p>Modifiez les informations du produit</p>
        </div>
    </section>

    <section class="edit-product-form">
        <div class="container">
            <div class="form-container">
                @include('partials.flash-messages')
                
                <form action="{{ route('admin.produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="current-product">
                        <h3>Produit actuel : {{ $produit->nom }}</h3>
                        <div class="current-info">
                            <div class="current-image">
                                @if($produit->image_url)
                                    <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" class="current-img">
                                @else
                                    <div class="no-image">
                                        <i class="fas fa-paw"></i>
                                        <p>Aucune image</p>
                                    </div>
                                @endif
                            </div>
                            <div class="current-details">
                                <p><strong>Catégorie :</strong> {{ ucfirst($produit->categorie) }}</p>
                                <p><strong>Prix :</strong> {{ number_format($produit->prix, 2, ',', ' ') }}€</p>
                                <p><strong>Stock :</strong> {{ $produit->quantite }} unités</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <!-- Nom du produit -->
                        <div class="form-group">
                            <label for="nom">Nom du produit *</label>
                            <input type="text" id="nom" name="nom" 
                                   value="{{ old('nom', $produit->nom) }}" 
                                   class="form-control @error('nom') is-invalid @enderror"
                                   required>
                            @error('nom')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Prix -->
                        <div class="form-group">
                            <label for="prix">Prix (€) *</label>
                            <input type="number" id="prix" name="prix" 
                                   step="0.01" min="0.01"
                                   value="{{ old('prix', $produit->prix) }}"
                                   class="form-control @error('prix') is-invalid @enderror"
                                   required>
                            @error('prix')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Catégorie -->
                        <div class="form-group">
                            <label for="categorie">Catégorie *</label>
                            <select id="categorie" name="categorie" 
                                    class="form-control @error('categorie') is-invalid @enderror"
                                    required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie }}" 
                                            {{ (old('categorie', $produit->categorie) == $categorie) ? 'selected' : '' }}>
                                        {{ ucfirst($categorie) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Quantité -->
                        <div class="form-group">
                            <label for="quantite">Quantité *</label>
                            <input type="number" id="quantite" name="quantite" 
                                   min="0"
                                   value="{{ old('quantite', $produit->quantite) }}"
                                   class="form-control @error('quantite') is-invalid @enderror"
                                   required>
                            @error('quantite')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="description">Description *</label>
                        <textarea id="description" name="description" 
                                  rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  required>{{ old('description', $produit->description) }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Nouvelle Image (optionnelle) -->
                    <div class="form-group full-width">
                        <label for="image">Nouvelle image (optionnel)</label>
                        <div class="image-upload-container">
                            <div class="image-preview" id="imagePreview">
                                <div class="preview-text">
                                    Conserver l'image actuelle ou sélectionner une nouvelle
                                </div>
                            </div>
                            <input type="file" id="image" name="image" 
                                   accept="image/*"
                                   class="form-control-file @error('image') is-invalid @enderror">
                            <small class="form-text text-muted">
                                Laisser vide pour conserver l'image actuelle. Formats acceptés: JPG, JPEG, PNG, GIF. Taille max: 5MB
                            </small>
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Boutons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i> Mettre à jour
                        </button>
                        <a href="{{ route('produits.show', $produit->id) }}" class="btn-secondary">
                            <i class="fas fa-eye"></i> Voir le produit
                        </a>
                    </div>
                </form>
                
                <!-- Formulaire de suppression séparé -->
                <form action="{{ route('admin.produits.destroy', $produit->id) }}" 
                      method="POST" 
                      class="delete-form"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prévisualisation de l'image
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imagePreview.innerHTML = '';
                const img = document.createElement('img');
                img.src = reader.result;
                img.classList.add('preview-image');
                imagePreview.appendChild(img);
            });
            
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<div class="preview-text">Conserver l\'image actuelle ou sélectionner une nouvelle</div>';
        }
    });
});
</script>
@endpush