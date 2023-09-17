<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Admin;
use App\Models\Catagory;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::with('admin')->get(['*']));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(PostRequest $request)
     {
         $input = $request->validated();
         $user_id = $request->user_id;
        $category_id= $request->category_id;
         $admin = Admin::where('id', $user_id)->first();
         $category= Catagory::where('id', $category_id)->first();


         if ($admin&&$category) {

             Post::create($input);
             return response()->json([
                 'message' => 'Post created successfully'
             ],200);
         }
          else
           if(!$admin) {

            if(!$admin&&!$category){

                return response()->json([
                    'error' => 'Admin and Catagory does not exist'
                ], 404);
             }
             else{
            return response()->json([
                'error' => 'Admin does not exist'
            ], 404);
        }
         }
         else
          if(!$category){
            return response()->json([
                'error' => 'Catagory does not exist'
            ], 404);
         }
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
