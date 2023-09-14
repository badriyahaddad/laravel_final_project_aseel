<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use App\Models\User;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data'=>Catagory::all(['*'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request,$userId)
     {
        $userId = User::findOrFail($userId)->id;

         $input = $request->validate([
             'title' => 'required|max:255',

         ]);

         Catagory::create($input);

         return response()->json([
             'message' => 'Catagory created successfully'
         ]);
     }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Catagory = Catagory::findOrFail($id);
        return response()->json([
            'data' => $Catagory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Catagory $request, string $id)
    {
        $input = $request->validated();

        $Catagory = Catagory::findOrFail($id);
        $Catagory->update($input);
        return response()->json([
            'message' => 'Catagory updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Catagory = Catagory::findOrFail($id);
        $Catagory->delete();
        return response()->json([
            'message' => 'Catagory deleted successfully'
        ]);
    }
}
