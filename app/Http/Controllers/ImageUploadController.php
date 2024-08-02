<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request, $folder)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Dynamic folder path
            $image->move(public_path("uploads/{$folder}"), $image_name);

            return response()->json(['image' => $image_name]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
    public function deleteImage($imageId)
    {
        $productImage = ProductImage::findOrFail($imageId);

        // Delete the image file
        File::delete(public_path('/uploads/productImage/' . $productImage->image));
        File::delete(public_path('/uploads/productImage/thumb/' . $productImage->image));

        // Delete the record from the database
        $productImage->delete();

        return response()->json(['success' => 'Product image deleted successfully.']);
    }
}
