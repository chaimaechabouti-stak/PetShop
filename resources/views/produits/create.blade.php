@extends('layout.app')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Ajouter un Nouveau Produit</h1>
            <p>Remplissez le formulaire pour ajouter un produit à notre boutique</p>
        </div>
    </section>

    <section class="add-product-form">
        <div class="container">
            <div class="form-container">
                @include('partials.flash-messages')
                
                <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                    @csrf
                    
                    <div class="form-grid">
                        <!-- Nom du produit -->
                        <div class="form-group">
                            <label for="nom">Nom du produit *</label>
                            <input type="text" id="nom" name="nom" 
                                   value="{{ old('nom') }}" 
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
                                   value="{{ old('prix') }}"
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
                                            {{ old('categorie') == $categorie ? 'selected' : '' }}>
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
                                   value="{{ old('quantite', 0) }}"
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
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Image -->
                    <div class="form-group full-width">
                        <label for="image">Image du produit *</label>
                        <div class="image-upload-container">
                            <div class="image-preview" id="imagePreview">
                                <div class="preview-text">Aucune image sélectionnée</div>
                            </div>
                            <input type="file" id="image" name="image" 
                                   accept="image/*"
                                   class="form-control-file @error('image') is-invalid @enderror"
                                   required>
                            <small class="form-text text-muted">
                                Formats acceptés: JPG, JPEG, PNG, GIF. Taille max: 5MB
                            </small>
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Boutons -->
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-plus-circle"></i> Ajouter le produit
                        </button>
                        <a href="{{ route('produits.index') }}" class="btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="form-info">
                <h3><i class="fas fa-info-circle"></i> Informations importantes</h3>
                <ul>
                    <li>Tous les champs marqués d'un * sont obligatoires</li>
                    <li>L'image sera automatiquement optimisée et stockée sur Cloudinary</li>
                    <li>Le produit sera immédiatement visible dans la boutique</li>
                    <li>Vous pourrez modifier ou supprimer le produit ultérieurement</li>
                </ul>
                
                <div class="category-examples">
                    <h4>Exemples de catégories :</h4>
                    <div class="category-tags">
                        <span class="category-tag chiens"><i class="fas fa-dog"></i> Chiens</span>
                        <span class="category-tag chats"><i class="fas fa-cat"></i> Chats</span>
                        <span class="category-tag oiseaux"><i class="fas fa-dove"></i> Oiseaux</span>
                        <span class="category-tag rongeurs"><i class="fas fa-hamster"></i> Rongeurs</span>
                        <span class="category-tag poissons"><i class="fas fa-fish"></i> Poissons</span>
                    </div>
                </div>
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
            imagePreview.innerHTML = '<div class="preview-text">Aucune image sélectionnée</div>';
        }
    });
    
    // Validation en temps réel
    const form = document.querySelector('.product-form');
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '' && this.hasAttribute('required')) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>
@endpush