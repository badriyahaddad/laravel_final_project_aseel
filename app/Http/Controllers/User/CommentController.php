<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        // return CommentResource::collection(Comment::with('user')->get(['*']));
        return CommentResource::collection(Comment::with('user', 'post')->get());
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(CommentRequest $request)
     {
         $input = $request->validated();
         $user_id = $request->user_id;
        $post_id= $request->post_id;
         $user = User::where('id', $user_id)->first();
         $post= Post::where('id', $post_id)->first();


         if ($user&&$post) {

            Comment::create($input);
             return response()->json([
                 'message' => 'Comment created successfully'
             ],200);
         }
          else
           if(!$user) {

            if(!$user&&!$post){

                return response()->json([
                    'error' => 'user and post does not exist'
                ], 404);
             }
             else{
            return response()->json([
                'error' => 'user does not exist'
            ], 404);
        }
         }
         else
          if(!$post){
            return response()->json([
                'error' => 'post does not exist'
            ], 404);
         }
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $Comment = Comment::findOrFail($id);
        // return response()->json([
        //     'data' => $Comment
        // ]);
        $comment = Comment::with('user', 'post')->findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Comment $request, string $id)
    {
        $input = $request->validated();

        $Comment = Comment::findOrFail($id);
        $Comment->update($input);
        return response()->json([
            'message' => 'Comment updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Comment = Comment::findOrFail($id);
        $Comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
