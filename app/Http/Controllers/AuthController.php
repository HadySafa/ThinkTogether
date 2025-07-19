<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'phonenumber' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'role' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        $validated = $validator->validated();

        $user = User::create([
            'fullname' => $validated['fullname'],
            'phonenumber' => $validated['phonenumber'],
            'username' => $validated['username'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['user' => $user], 201);
    }

    // login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        $validated = $validator->validated();

        if (! $token = auth('api')->attempt($validated)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'token' => $token,
        ], 200);
    }

    public function checkUsername(Request $request)
    {
        $validator = Validator::make($request->query(), [
            'username' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid username parameter.'
            ], 400);
        }

        $validated = $validator->validated();

        $user = User::where('username', $validated['username'])->first();

        return response()->json(['available' => $user ? "false" : "true"],200);
        
    }
}