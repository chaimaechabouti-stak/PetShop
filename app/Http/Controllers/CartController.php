<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $cart = session('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product' => $produit->toArray(),
                'quantity' => 1
            ];
        }
        
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Produit ajouté au panier');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
        
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processPayment(Request $request)
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }
        
        // Essayer plusieurs noms de variables pour Vercel et local
        $stripeSecret = $_ENV['STRIPE_SECRET'] 
            ?? $_ENV['STRIPE_SECRET_KEY'] 
            ?? getenv('STRIPE_SECRET') 
            ?? getenv('STRIPE_SECRET_KEY') 
            ?? config('stripe.secret') 
            ?? env('STRIPE_SECRET')
            ?? env('STRIPE_SECRET_KEY');
        
        // Dernière tentative: lire directement .env en local
        if (!$stripeSecret && file_exists(base_path('.env'))) {
            $envContent = file_get_contents(base_path('.env'));
            if (preg_match('/STRIPE_SECRET(?:_KEY)?=(.+)/', $envContent, $matches)) {
                $stripeSecret = trim($matches[1]);
            }
        }
        
        if (!$stripeSecret) {
            return redirect()->route('cart.index')->with('error', 'Configuration Stripe manquante. Vérifiez les variables d\'environnement sur Vercel.');
        }
        
        try {
            Stripe::setApiKey($stripeSecret);
            
            $lineItems = [];
            foreach ($cart as $item) {
                $product = is_array($item['product']) ? (object)$item['product'] : $item['product'];
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $product->nom,
                        ],
                        'unit_amount' => $product->prix * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Erreur Stripe: ' . $e->getMessage());
        }
    }

    public function success()
    {
        session()->forget('cart');
        return view('cart.success');
    }

    public function cancel()
    {
        return view('cart.cancel');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $product = is_array($item['product']) ? (object)$item['product'] : $item['product'];
            $total += $product->prix * $item['quantity'];
        }
        return $total;
    }
}
