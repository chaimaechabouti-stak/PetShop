<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

use Cloudinary\Cloudinary;

class ProductResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(9);
        $categories = Produit::select('categorie')->distinct()->get();
        
        return view('produits.index', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ['chiens', 'chats', 'oiseaux', 'rongeurs', 'poissons'];
        
        return view('produits.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'prix' => 'required|numeric|min:0.01',
            'categorie' => 'required|in:chiens,chats,oiseaux,rongeurs,poissons',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif|max:5120',
            'quantite' => 'required|integer|min:0'
        ]);
        
        $imageUrl = null;
        
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_KEY'),
                    'api_secret' => env('CLOUDINARY_SECRET')
                ]
            ]);
            
            $uploadedImage = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'produits'
            ]);
            
            $imageUrl = $uploadedImage['secure_url'];
        }

        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->categorie = $request->categorie;
        $produit->en_stock = ($request->quantite ?? 1) > 0;
        $produit->quantite = $request->quantite;
        
        if ($imageUrl) {
            $produit->image = $imageUrl;
        }
        
        $produit->save();

        return redirect()->route('produits.index')
            ->with('success', 'Produit ajouté avec succès!');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = ['chiens', 'chats', 'oiseaux', 'rongeurs', 'poissons'];
        
        return view('produits.edit', [
            'produit' => $produit,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        
        $validated = $request->validate([
            'nom' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'prix' => 'required|numeric|min:0.01',
            'categorie' => 'required|in:chiens,chats,oiseaux,rongeurs,poissons',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif|max:5120',
            'quantite' => 'required|integer|min:0'
        ]);

        // Mise à jour des champs de base
        $produit->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'categorie' => $validated['categorie'],
            'en_stock' => $validated['quantite'] > 0,
            'quantite' => $validated['quantite']
        ]);

        // Mise à jour de l'image si fournie
        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_KEY'),
                    'api_secret' => env('CLOUDINARY_SECRET')
                ]
            ]);
            
            $uploadedImage = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'produits'
            ]);

            $produit->update([
                'image' => $uploadedImage['secure_url']
            ]);
        }

        return redirect()->route('produits.show', $produit->id)
            ->with('success', 'Produit modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé avec succès!');
    }
}