<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart(Request $request, Product $product){

        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
            ]);
        }

        $cartItems = $cart->items;

        return view('user.cart', compact('cartItems'));

    }
    public function addToCart(Request $request, Product $product)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' =>  $request->product_id,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function removeFromCart(Request $request, CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('users.cart')->with('success', 'Product removed from cart successfully.');
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('users.cart')->with('success', 'Quantity updated successfully.');
    }

    public function emptyCart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->route('users.cart')->with('success', 'Cart emptied successfully.');
    }

    public function report()
    {
        $cartItems = CartItem::with('product')
            ->whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('quantity', 'desc')
            ->get();

        return view('user.cartReport', compact('cartItems'));
    }
}
