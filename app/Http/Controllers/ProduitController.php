<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Afficher tous les produits avec pagination
     */
    public function index()
    {
        // Pagination avec Eloquent (6 produits par page)
        $produits = Produit::paginate(6);
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('produits.index', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }

    /**
     * Afficher les produits par catégorie avec pagination
     */
    public function getProductsByCategorie($cat)
    {
        // Pagination avec Eloquent WHERE
        $produits = Produit::where('categorie', $cat)->paginate(6);
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('produits.index', [
            'produits' => $produits,
            'categorie_selected' => $cat,
            'categories' => $categories
        ]);
    }

    /**
     * Afficher un produit spécifique
     */
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('produits.show', [
            'produit' => $produit,
            'categories' => $categories
        ]);
    }

    /**
     * Rechercher des produits avec pagination
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Produit::select('categorie')->distinct()->get();
        
        // Pagination avec recherche
        $produits = Produit::where('nom', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(6)
            ->appends(['query' => $query]); // Garder le paramètre query dans la pagination
        
        return view('produits.index', [
            'produits' => $produits,
            'categories' => $categories,
            'search_query' => $query
        ]);
    }

    /**
     * Exemple d'utilisation de SQL natif (comme dans le document)
     */
    public function produitsSQL($cat)
    {
        // Utilisation de SQL natif comme dans l'exemple du document
        $query = "SELECT * FROM produits WHERE categorie = ?";
        $produits = DB::select($query, [$cat]);
        
        // Convertir en pagination manuelle si nécessaire
        // Note: DB::select() ne supporte pas directement paginate()
        
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('produits.sql', [
            'produits' => $produits,
            'categorie_selected' => $cat,
            'categories' => $categories
        ]);
    }

    /**
     * Afficher le formulaire d'envoi d'email
     */
    public function email($id)
    {
        $produit = Produit::findOrFail($id);
        return view('emails.form', compact('produit'));
    }

    /**
     * Envoyer l'email de recommandation
     */
    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email',
            'recipient_email' => 'required|email',
            'message' => 'nullable|string|max:1000',
        ]);

        $produit = Produit::findOrFail($id);

        try {
            \Mail::to($request->recipient_email)->send(
                new \App\Mail\ProductEmail(
                    $produit,
                    $request->message,
                    $request->sender_name,
                    $request->sender_email
                )
            );

            return redirect()->back()->with('success', 'Email envoyé avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi de l\'email.');
        }
    }
}