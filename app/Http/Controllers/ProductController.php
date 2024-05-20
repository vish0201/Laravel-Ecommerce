<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('AdminComponents.Products.index', compact('products'));
    }

    public function getallproducts()
    {
        $products = Product::all();

        return view('AdminComponents.Products.product', compact('products'));
    }


    public function create()
    {

        $categories = ProductCategory::all();

        return view("AdminComponents.Products.create", compact('categories'));
    }


    public function toggleFeatured(Request $request, $productId)
    {
        // Retrieve the category by its ID
        $product = Product::findOrFail($productId);
        
        // Toggle the featured status
        $product->featured = !$product->featured;
    
        // Save the changes
        $product->save();
        
        return back()->with('success', 'Category featured status toggled successfully.');
    }



    public function store(Request $request)    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:product_categories,id', // Assuming 'categories' is your categories table
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Assuming maximum file size is 2MB
        ]);
    
        // Create a new product instance
        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'cat_id' => $validatedData['category'],
        ]);
    

        // Handle image upload
        if ($request->hasFile('images')) {


            $directory = public_path('uploads/productsImages');

            // Create the directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Store each image
                $filename = $image->getClientOriginalName();
                $image->move($directory, $filename); // You might want to customize the storage path
    
                // Add image filename to the array
                $imagePaths[] = $filename;
            }
    
            // Save image filenames in the product model
            $product->images = $imagePaths;
            $product->save();
        }
    
        // Redirect back with a success message
        return redirect()->route('product.product')->with('success', 'Product created successfully!');
    }
    






    public function delete($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('product.product')->with('success', 'Product deleted successfully!');
    }
}
