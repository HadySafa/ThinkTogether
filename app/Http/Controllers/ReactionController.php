<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $reactions = Reaction::with('user:id,username')->where('post_id', $id)->get();
        return response()->json(['reactions' => $reactions], 200);
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
    public function store(Request $request,$id)
    {
        //
        $validator = Validator::make($request->all(), [
            'reaction' => 'required|string',
        ]);

        
        if ($validator->fails()) {
            return response()->json(['message' => 'incorrect data.'], 422);
        }
    
        $validated = $validator->validated();
        $user = auth('api')->user();

        $reaction = Reaction::create([
            'user_id' => $user->id,
            'post_id' => $id,
            'reaction' => $validated['reaction'],
        ]);

        return response()->json(['reaction' => $reaction], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reaction $reaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reaction $reaction)
    {
        //
    }
}
