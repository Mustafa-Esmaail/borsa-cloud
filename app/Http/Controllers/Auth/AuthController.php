<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation logic
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


            if (Auth::attempt($request->only('email', 'password'))) {
                if(auth()->user()->office->status  == 'inactive'){
                    return response()->json(['message' => "office not exist"],401);
                }
                // Generate token
                $token = auth()->user()->createToken('auth-token')->plainTextToken;

                // Return response
                return response()->json(['token' => $token, 'user' => auth()->user()]);
            }
            else{
                return response()->json(['message' => 'Invalid credentials'], 401);
            }


        // Attempt login


        // Return error response
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
        $details = [
            'name' => $request->name,

        ];

        // Mail::to($request->email)->send(new \App\Mail\EmailVerification($details));
        // event(new Registered($user));

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

    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Verify the current password
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect'], 401);
    }



    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json(['message' => 'Password changed successfully']);
}
public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $characters = '0123456789';
        $otp = '';
        $length=6;
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, $max)];
        }
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $otp, 'created_at' => now()]
        );

        // Send reset email
        Mail::to($user->email)->send(new ResetPasswordMail($user, $otp));

        return response()->json(['message' => 'Reset password email sent successfully']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
            'password' => 'required', // Adjust as needed
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$passwordReset) {
            return response()->json(['error' => 'Invalid or expired token'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset token
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }

}
