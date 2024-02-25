<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation logic
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Generate token
            $token = auth()->user()->createToken('auth-token')->plainTextToken;

            // Return response
            return response()->json(['token' => $token, 'user' => auth()->user()]);
        }

        // Return error response
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        // Validation logic
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'office_id' => 'required',
        ]);

        // Create user
        $user = User::create([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate token
        $token = $user->createToken('auth-token')->plainTextToken;

        // Return response
        return response()->json(['token' => $token, 'user' => $user]);
    }
    public function userDetails()
    {
        if (Auth::check()) {

            $user = Auth::user();

            return response()->json(['data' => $user],200);
        }

        return response()->json(['data' => 'Unauthorized'],401);
    }
}
