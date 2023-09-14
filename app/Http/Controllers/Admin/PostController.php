<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Admin;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json([
        //     'data'=>Post::all(['*'])
        // ]);
        return PostResource::collection(Post::with('admin')->get(['*']));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {

         $input = $request->validate([
             'title' => 'required|max:255',
             'content' => 'required',
             'location' => 'required',
             'image' => 'required',
             'user_id' => 'required',
             'category_id' => 'required',
        ]);
            Admin::findOrFail($request->user_id)->id;

         Post::create($input);

         return response()->json([
             'message' => 'Post created successfully'
         ]);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Post = Post::findOrFail($id);
        return response()->json([
            'data' => $Post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $request, string $id)
    {
        $input = $request->validated();

        $Post = Post::findOrFail($id);
        $Post->update($input);
        return response()->json([
            'message' => 'Post updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Post = Post::findOrFail($id);
        $Post->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
