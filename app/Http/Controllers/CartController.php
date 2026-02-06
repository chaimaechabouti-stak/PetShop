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
        
        Stripe::setApiKey(config('stripe.secret'));
        
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
