<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        // Tous les produits pour l'admin
        $produits = Produit::orderBy('created_at', 'desc')->paginate(5);
        $totalProduits = Produit::count();
        $categories = Produit::select('categorie')->distinct()->get();
        $produitsEnSolde = Produit::where(function($query) {
            $query->where('prix', '<', 200)
                  ->orWhere('en_solde', true);
        })->count();

        return view('dashboard.index', compact('user', 'produits', 'totalProduits', 'categories', 'produitsEnSolde'));
    }

    public function soldes()
    {
        // Tous les produits en solde avec tri par prix croissant
        $produitsEnSolde = Produit::where(function($query) {
            $query->where('prix', '<', 200)
                  ->orWhere('en_solde', true);
        })
        ->orderBy('prix', 'asc')
        ->paginate(12);
        
        return view('dashboard.soldes', compact('produitsEnSolde'));
    }
}