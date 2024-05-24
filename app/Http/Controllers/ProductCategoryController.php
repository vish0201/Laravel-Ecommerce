<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller


{


    public function show()
    {
        $categories = ProductCategory::paginate(10);
        return view("AdminComponents.categories.categories", compact('categories'));
    }


    public function create()
    {
        return view("AdminComponents.categories.create");
    }


    public function edit(ProductCategory $category)
    {

        return view('AdminComponents.categories.create', compact('category'));
    }


    public function showProducts(Request $request, $categoryId = null)
    {
        $categories = ProductCategory::whereHas('products')->get();
        if ($categoryId) {
            $products = Product::where('cat_id', $categoryId)->paginate(10);
        } else {
            $products = Product::paginate(10);
        }
        

        if ($request->ajax()) {
            return view('UserComponents.partials.products', compact('products'))->render();
        }

        return view('UserComponents.pages.product', compact('categories', 'products'));
    }





    public function toggleFeatured(Request $request, $categoryId)
    {
        // Retrieve the category by its ID
        $category = ProductCategory::findOrFail($categoryId);

        // Toggle the featured status
        $category->featured = !$category->featured;

        // Save the changes
        $category->save();

        return back()->with('success', 'Category featured status toggled successfully.');
    }




    public function store(Request $request)

    {

        $category = new ProductCategory([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);


        if ($request->hasFile('image')) {
            // Define the directory where the image will be stored
            $directory = public_path('uploads/category');

            // Create the directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Store the uploaded image in the "category" folder
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $imageName);

            // Save the image path to the category model
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('category.category')->with('success', 'category created successfully!');
    }


    public function update(Request $request, ProductCategory $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Define the directory where the image will be stored
            $directory = public_path('uploads/category');

            // Create the directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Delete the previous image if exists
            if ($category->image) {
                $previousImagePath = $directory . '/' . $category->image;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            // Store the new uploaded image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $imageName);

            // Save the image path to the category model
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('category.category')->with('success', 'Category updated successfully');
    }



    public function delete($id)
    {
        // Find the category by its ID
        $category = ProductCategory::findOrFail($id);

        // Delete the associated image from the folder
        $imagePath = public_path('uploads/category/' . $category->image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }

        // Delete the category
        $category->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('category.category')->with('success', 'Category deleted successfully!');
    }
}
