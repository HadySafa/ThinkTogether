<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $tags = Tag::where('post_id', $id)->get();
        return response()->json(['tags' => $tags], 200);
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
    public function store(Request $request, $id)
    {
        //

        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found.'], 404);
        }

        $user = auth('api')->user();

        if ($user->id !== $post->user_id) {
            return response()->json(['message' => 'Not allowed to perform this action.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'tags' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "tags must be an array"], 422);
        }

        $validated = $validator->validated();

        $tags = $validated['tags'];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'post_id' => $id
            ]);
        }

        return response()->json(['message' => "tags where added successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
