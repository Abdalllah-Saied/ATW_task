<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $user = Auth::user();
            $posts = $user->posts;
            return response()->json($posts);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
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
        try{
            $request->validate([
                'title' => 'required|max:255',
                'body' => 'required',
                'cover_image' => 'required|image',
                'pinned' => 'required|boolean',
                'tags' => 'required|array',
                'tags.*' => 'exists:tags,id',
            ]);

            $user = Auth::user();

            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->cover_image = $request->file('cover_image')->store('images');
            $post->pinned = $request->pinned;

            $user->posts()->save($post);
            $post->tags()->attach($request->tags);

            $post->load('tags'); // Load the tags relationship

            return response()->json($post, 201);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try{
            $user = Auth::user();

            if ($user->id !== $post->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $post->load('tags'); // Load the tags relationship

            return response()->json($post);
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
    public function update(Request $request, Post $post)
    {
        try{
            $user = Auth::user();

            if ($user->id !== $post->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $request->validate([
                'title' => 'required|max:255',
                'body' => 'required',
                'cover_image' => 'image',
                'pinned' => 'required|boolean',
                'tags' => 'array',
                'tags.*' => 'exists:tags,id',
            ]);

            $post->title = $request->title;
            $post->body = $request->body;
            $post->pinned = $request->pinned;

            if ($request->hasFile('cover_image')) {
                $post->cover_image = $request->file('cover_image')->store('images');
            }

            $post->tags()->sync($request->tags);

            $post->save();

            $post->load('tags'); // Load the tags relationship

            return response()->json($post);
        }catch (\Throwable $th){
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ],500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try{
            $user = Auth::user();

            if ($user->id !== $post->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $post->delete();
            return response()->json(null, 204);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function deletedPosts()
    {
        try{
            $user = Auth::user();
            $deletedPosts = $user->posts()->onlyTrashed()->get();
            return response()->json($deletedPosts);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function restoreDeletedPost($id)
    {
        try{
            $user = Auth::user();
            $post = $user->posts()->onlyTrashed()->where('id', $id)->first();

            if (!$post) {
                return response()->json(['error' => 'Post not found'], 404);
            }

            $post->restore();
            return response()->json($post);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'error',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
