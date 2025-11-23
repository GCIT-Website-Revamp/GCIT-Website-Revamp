<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session ID to prevent fixation
            $request->session()->regenerate();
            
            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => '/admin/dashboard'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.'
        ], 401);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
            'redirect' => '/admin'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Your current password is incorrect.'
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Regenerate session for security
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.',
            'redirect' => '/admin/profile'
        ]);
    }
}
