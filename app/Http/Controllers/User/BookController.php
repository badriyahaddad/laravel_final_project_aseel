<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection(Book::with('post','user')->get(['*']));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(BookRequest $request)
     {
         $input = $request->validated();
         $user_id = $request->user_id;
        $post_id= $request->post_id;
         $user = User::where('id', $user_id)->first();
         $post= Post::where('id', $post_id)->first();


         if ($user&&$post) {

            Book::create($input);
             return response()->json([
                 'message' => 'Book appointment created successfully'
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
        $Book = Book::findOrFail($id);
        return response()->json([
            'data' => $Book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Book $request, string $id)
    {
        $input = $request->validated();

        $Book = Book::findOrFail($id);
        $Book->update($input);
        return response()->json([
            'message' => 'Book updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Book = Book::findOrFail($id);
        $Book->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }
}
