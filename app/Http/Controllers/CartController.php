<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function getCartPage()
    {
        // Retrieve cart items and calculate totals
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = 50;

        $total  = $subtotal + $shipping;

        // You can calculate shipping and total here based on your business logic

        return view('UserComponents.pages.cart', compact('cartItems', 'subtotal' , 'shipping' , 'total'));
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.page')->with('success', 'Cart updated successfully!');
    }

    public function addToCart(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            // Redirect to login/signup page
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');

        // Check if the product is already in the cart
        $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($existingCartItem) {
            return redirect()->back()->with('error', 'Product already added to cart.');
        }

        Cart::create($request->all());

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function getCart()
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }

        $user_id = Auth::id();
        $cartItems = Cart::where('user_id', $user_id)->get();

        return view('cart', compact('cartItems'));
    }


    public function removeFromCart(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            // Redirect to login/signup page
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');

        // Find and delete the cart item
        Cart::where('user_id', $userId)->where('product_id', $productId)->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
