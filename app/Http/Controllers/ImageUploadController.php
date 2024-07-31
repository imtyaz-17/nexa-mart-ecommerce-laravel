<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request, $folder)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            // Dynamic folder path
            $image->move(public_path("uploads/{$folder}"), $image_name);

            return response()->json(['image' => $image_name]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
