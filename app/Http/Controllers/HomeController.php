<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $produits = Produit::orderBy('created_at', 'desc')->paginate(9);
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('home', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }
}
