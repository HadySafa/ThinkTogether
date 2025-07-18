<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
}
