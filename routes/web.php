<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProductResourceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;

// Page d'accueil publique
Route::get('/', HomeController::class)->name('home');

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes publiques pour les produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{cat}', [ProduitController::class, 'getProductsByCategorie'])->name('produits.categorie');
Route::get('/produit/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/search', [ProduitController::class, 'search'])->name('produits.search');
Route::get('/soldes', [DashboardController::class, 'soldes'])->name('produits.soldes');

// Routes pour l'envoi d'emails
Route::get('/produit/{id}/email', [ProduitController::class, 'email'])->name('produits.email');
Route::post('/produit/{id}/send-email', [ProduitController::class, 'sendEmail'])->name('produits.sendEmail');

// Routes protégées par authentification (admin seulement)
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des produits (admin)
    Route::resource('admin/produits', ProductResourceController::class)
        ->names([
            'index' => 'admin.produits.index',
            'create' => 'admin.produits.create',
            'store' => 'admin.produits.store',
            'show' => 'admin.produits.show',
            'edit' => 'admin.produits.edit',
            'update' => 'admin.produits.update',
            'destroy' => 'admin.produits.destroy'
        ]);
    
    // Lien pour ajouter un produit
    Route::get('/ajouter-produit', [ProductResourceController::class, 'create'])
        ->name('produits.create.public');
});

// Pages statiques
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
