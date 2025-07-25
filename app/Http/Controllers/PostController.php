<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request()->query('search');
        if ($search) $posts = $this->searchPosts($search);
        else $posts = Post::with(['user:id,username', 'category:id,name'])->get();
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
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'link' => 'nullable|string',
            'codesnippet' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data.'], 422);
        }

        $validated = $validator->validated();
        $user = auth('api')->user();

        $post = Post::create([
            'user_id' => $user->id,
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
    public function update(Request $request, Post $post, $id)
    {
        //
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => "Post not found."], 404);
        }

        $user = auth('api')->user();

        if($user->id !== $post->user_id){
            return response()->json(['message' => "You are not allowed to perform this action."], 403);
        }

        $post->update($request->only(['title', 'description', 'link', 'codesnippet']));
        return response()->json(['id' => $post->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth('api')->user()->id) {
            return response()->json(['message' => 'You are not allowed to perform this action.'], 403);
        }
        
        $post->delete();
        
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    public function postsByUser($id)
    {
        $posts = Post::with(['user:id,username', 'category:id,name'])->where('user_id', $id)->get();
        return response()->json(['posts' => $posts], 200);
    }

    public function postsByCategory($id)
    {
        $posts = Post::with(['user:id,username', 'category:id,name'])->where('category_id', $id)->get();
        return response()->json(['posts' => $posts], 200);
    }

    public function topPosts()
    {
        $posts = Post::withCount([
            'reactions as like_count' => function ($query) {
                $query->where('reaction', 'like');
            }
        ])
            ->with(['user:id,username', 'category:id,name'])
            ->orderByDesc('like_count')
            ->get();
        return response()->json(['posts' => $posts], 200);
    }

    public function searchPosts($search)
    {
        $posts = Post::with(['user:id,username', 'category:id,name'])
            ->whereHas('tags', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->get();
        return $posts;
    }
}
