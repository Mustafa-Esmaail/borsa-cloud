<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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
            'office_id' => 'required|exists:offices,id',
        ]);

        // Create user
        $user = User::create([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        event(new Registered($user));

    $user->sendEmailVerificationNotification();

    return response()->json(['message' => 'User registered successfully. Please check your email for verification.']);

        // // Generate token
        // $token = $user->createToken('auth-token')->plainTextToken;

        // Return response
        // return response()->json(['token' => $token, 'user' => $user]);
    }
    public function userDetails()
    {
        if (Auth::check()) {

            $user = User::with(['office'])->find(auth()->user()->id);

            return response()->json(['data' => $user],200);
        }

        return response()->json(['data' => 'Unauthorized'],401);
    }
    public function logout()
{
    auth()->user()->tokens()->delete();

    return response()->json(['message' => 'Successfully logged out'] ,200);
}
public function changePassowrd(Request $request)
{

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required', // Adjust as needed
        'confirm_password' => 'required',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Verify the current password
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect'], 401);
    }
    if (!$request->new_password== $user->confirm_password) {
        return response()->json(['message' => 'Confirm Password  is not match '], 401);
    }


    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password changed successfully']);
}

}
