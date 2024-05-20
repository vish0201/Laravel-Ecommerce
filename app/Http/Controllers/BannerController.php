<?php



// app/Http/Controllers/BannerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('AdminComponents.banners.banner', compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'bannerImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
        ]);

        // Create a new banner instance
        $banner = new Banner([
            'featured' => $request->input('featured', false),
        ]);

        // Check if an image file is uploaded
        if ($request->hasFile('bannerImage')) {
            // Define the directory where the image will be stored
            $directory = public_path('uploads/banners');

            // Create the directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Store the uploaded image in the "banners" folder
            $image = $request->file('bannerImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $imageName);

            // Save the image path to the banner model
            $banner->image =  $imageName;
        }

        // Save the banner to the database
        $banner->save();
        return redirect()->route('banners')->with('success', 'banner created  successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update($request->all());
        return response()->json($banner, 200);
    }


    public function toggleFeatured(Request $request, $bannerId)
    {
        // Retrieve the banner by its ID
        $banner = Banner::findOrFail($bannerId);

        // Toggle the featured status
        $banner->featured = !$banner->featured;

        // Save the changes
        $banner->save();

        return back()->with('success', 'Banner featured status toggled successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete the associated image from the folder
        $imagePath = public_path('uploads/banners/' . $banner->image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }
        $banner->delete();
        return redirect()->route('banners')->with('success', 'banner deleted successfully!');
    }
}
