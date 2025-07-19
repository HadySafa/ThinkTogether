<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return response()->json(['posts' => $posts], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'link' => 'string',
            'codesnippet' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        $validated = $validator->validated();

        $post = Post::create([
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link' => $validated['link'] ?? null,
            'codesnippet' => $validated['codesnippet'] ?? null,
        ]);

        return response()->json(['id' => $post->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth('api')->user()->id) {
            return response()->json(['message' => 'Not allowed to delete this post'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'],200);
    }
}
