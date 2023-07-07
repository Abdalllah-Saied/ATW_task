<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tags = Tag::all();
            return response()->json($tags);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'name' => 'required|unique:tags',
            ]);

            $tag = Tag::create($request->all());
            return response()->json($tag, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json(['error' => 'Tag not found'], 404);
            }

            return response()->json($tag);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        try{
//            dd($request);
            $request->validate([
                'name' => 'required|unique:tags,name,' . $tag->id,
            ]);

            $tag->update($request->all());
            return response()->json($tag);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try{
            $tag->delete();
            return response()->json([
                'message' =>'tag deleted successfuly'
            ], 204);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
