<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\GCITMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private function generateOtp()
    {
        return 'GCIT' . rand(1000, 9999);
    }
    public function getAllUsers()
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUser(User $user)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'password' => 'required',
                'contact_no' => 'nullable|string|max:30',
                'enabled' => 'required|boolean'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->contact_no = $request->contact_no;
            $user->enabled = $request->enabled;
            $user->otp = $this->generateOtp();
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', 'max:255'],
                'contact_no' => 'nullable|string|max:30',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_no = $request->contact_no ?? null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleEnabled($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->enabled = !$user->enabled;
            $user->save();

            $status = $user->enabled ? 'enabled' : 'disabled';

            return response()->json([
                'success' => true,
                'message' => "User has been {$status} successfully!",
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle user status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'new_password' => 'required|min:6',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find user by email
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found with provided email.'
                ], 404);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully!',
                'data' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'otp' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find user by email
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            // Check OTP
            if ($user->otp !== $request->otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.'
                ], 400);
            }

            // OTP is correct → regenerate new OTP
            $user->otp = $this->generateOtp();
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!',
                'data' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendOtpEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            // Find user
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            // Send email
            Mail::to($user->email)->send(new GCITMail($user->otp));

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}