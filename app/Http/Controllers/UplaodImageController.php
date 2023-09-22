<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UplaodImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);

        //     return response()->json(['message' => 'Image uploaded successfully']);
        // } else {
        //     return response()->json(['message' => 'No image file found'], 400);
        // }
        $image = $request->file('image')->store('public');
        $image = explode('/',$image)[1];
        return response()->json([
            'image_name'=>$image,
            'image_base_url'=>url('/storage'),
            'full_path'=>url('/') . '/storage/' . $image
        ]);
    }
}
