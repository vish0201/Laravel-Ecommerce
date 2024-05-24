<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{

    public function addToBookmark(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            // Redirect to login/signup page
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }
    
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);
    
        $userId = Auth::id();
        $productId = $request->input('product_id');
    
        // Check if the product is already bookmarked
        $existingBookmark = Bookmark::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($existingBookmark) {
            return redirect()->back()->with('error', 'Product already bookmarked.');
        }
    
        Bookmark::create($request->all());
    
        return redirect()->back()->with('success', 'Product bookmarked successfully!');
    }
    


    public function getBookmarks()
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }

        $user_id = Auth::id();
        $bookmarks = Bookmark::where('user_id', $user_id)->get();

        return view('UserComponents.Partials.saved', compact('bookmarks'));
    }

    
    public function removeFromBookmark(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            // Redirect to login/signup page
            return redirect()->route('user.login')->with('error', 'Please login or sign up to continue.');
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');

        // Find and delete the cart item
        Bookmark::where('user_id', $userId)->where('product_id', $productId)->delete();

        return redirect()->back()->with('success', 'Product removed from Bookmark successfully!');
    }
}
