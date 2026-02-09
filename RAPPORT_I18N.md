# Rapport d'implémentation i18n - Page d'accueil

## 1. Fichiers de traduction créés

### resources/lang/fr/home.php (Français)
```php
<?php

return [
    'hero' => [
        'title' => 'Nourriture Premium pour Animaux',
        'subtitle' => 'Des aliments sains, naturels et équilibrés pour la santé et le bien-être de vos compagnons',
        'cta' => 'Découvrir nos produits',
    ],
    
    'features' => [
        'title' => 'Pourquoi choisir Paws & Bowls ?',
        'natural' => [
            'title' => '100% Naturel',
            'description' => 'Des ingrédients naturels, sans conservateurs artificiels ni colorants',
        ],
        'quality' => [
            'title' => 'Qualité Premium',
            'description' => 'Des produits certifiés par des vétérinaires et nutritionnistes',
        ],
        'delivery' => [
            'title' => 'Livraison Rapide',
            'description' => 'Livraison gratuite à partir de 50€ d\'achat',
        ],
        'ethical' => [
            'title' => 'Éthique & Durable',
            'description' => 'Emballages recyclables et engagement envers le bien-être animal',
        ],
    ],
    
    'products' => [
        'title' => 'Nos Produits Phares',
        'add_to_cart' => 'Ajouter au panier',
    ],
];
```

### resources/lang/en/home.php (Anglais)
```php
<?php

return [
    'hero' => [
        'title' => 'Premium Pet Food',
        'subtitle' => 'Healthy, natural and balanced food for the health and well-being of your companions',
        'cta' => 'Discover our products',
    ],
    
    'features' => [
        'title' => 'Why choose Paws & Bowls?',
        'natural' => [
            'title' => '100% Natural',
            'description' => 'Natural ingredients, without artificial preservatives or colorants',
        ],
        'quality' => [
            'title' => 'Premium Quality',
            'description' => 'Products certified by veterinarians and nutritionists',
        ],
        'delivery' => [
            'title' => 'Fast Delivery',
            'description' => 'Free delivery from €50 purchase',
        ],
        'ethical' => [
            'title' => 'Ethical & Sustainable',
            'description' => 'Recyclable packaging and commitment to animal welfare',
        ],
    ],
    
    'products' => [
        'title' => 'Our Featured Products',
        'add_to_cart' => 'Add to cart',
    ],
];
```

## 2. Configuration de la langue par défaut

### config/app.php
```php
'locale' => env('APP_LOCALE', 'fr'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'fr'),
```

### .env
```env
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
```

## 3. Gestion de la route de changement de langue

### app/Http/Controllers/LanguageController.php
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (in_array($locale, ['en', 'fr'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        
        return redirect()->back();
    }
}
```

### routes/web.php
```php
// Changement de langue
Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');
```

### app/Http/Middleware/SetLocale.php
```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
        
        return $next($request);
    }
}
```

### bootstrap/app.php
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        \App\Http\Middleware\SetLocale::class,
    ]);
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
    // ...
})
```

## 4. Référencement des traductions dans la vue

### resources/views/pages/home.blade.php

**Section Hero :**
```blade
<h2>{{ __('home.hero.title') }}</h2>
<p>{{ __('home.hero.subtitle') }}</p>
<a href="#" class="btn-primary">{{ __('home.hero.cta') }}</a>
```

**Section Features :**
```blade
<h2 class="section-title">{{ __('home.features.title') }}</h2>

<h3>{{ __('home.features.natural.title') }}</h3>
<p>{{ __('home.features.natural.description') }}</p>

<h3>{{ __('home.features.quality.title') }}</h3>
<p>{{ __('home.features.quality.description') }}</p>

<h3>{{ __('home.features.delivery.title') }}</h3>
<p>{{ __('home.features.delivery.description') }}</p>

<h3>{{ __('home.features.ethical.title') }}</h3>
<p>{{ __('home.features.ethical.description') }}</p>
```

**Section Products :**
```blade
<h2 class="section-title">{{ __('home.products.title') }}</h2>
<button class="btn-secondary">{{ __('home.products.add_to_cart') }}</button>
```

## 5. Sélecteur de langue dans la navigation

### resources/views/partials/navigation.blade.php
```blade
<div class="lang-switcher">
    <a href="{{ route('lang.switch', 'fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">
        FR
    </a>
    <span>|</span>
    <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
        EN
    </a>
</div>
```

**CSS :**
```css
.lang-switcher {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-right: 20px;
}

.lang-switcher a {
    color: #666;
    text-decoration: none;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 4px;
    transition: all 0.3s;
}

.lang-switcher a.active {
    color: #4CAF50;
    background: #f0f0f0;
}

.lang-switcher a:hover {
    color: #4CAF50;
}

.lang-switcher span {
    color: #ccc;
}
```

## 6. Fonctionnement

1. **Langue par défaut** : Français (fr)
2. **Langues disponibles** : Français (fr) et Anglais (en)
3. **Stockage** : La langue sélectionnée est sauvegardée en session
4. **Changement** : Cliquer sur FR ou EN dans la navigation
5. **Persistance** : La langue reste active pendant toute la session

## 7. Utilisation de la fonction __()

La fonction `__('fichier.clé')` permet de récupérer les traductions :
- `__('home.hero.title')` → Cherche dans `resources/lang/{locale}/home.php` la clé `['hero']['title']`
- Laravel utilise automatiquement la locale active (fr ou en)

## 8. Fichiers modifiés/créés

**Créés :**
- resources/lang/fr/home.php
- resources/lang/en/home.php
- app/Http/Controllers/LanguageController.php
- app/Http/Middleware/SetLocale.php

**Modifiés :**
- resources/views/pages/home.blade.php
- resources/views/partials/navigation.blade.php
- config/app.php
- .env
- routes/web.php
- bootstrap/app.php

## 9. Avantages

✅ Multilingue (FR/EN)
✅ Facile à étendre (ajouter d'autres langues)
✅ Centralisé (tous les textes dans des fichiers de traduction)
✅ Maintenable (modification des textes sans toucher aux vues)
✅ Persistant (langue sauvegardée en session)
