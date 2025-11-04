<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getAllUsers()
    {
        // Fetch all Projects from DB
        $users = User::all();
        return response()->json($users);
    }

    public function getUser(User $user)
    {
        return response()->json($user);
    }

    public function createUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255','unique:users'],
            'password' => 'required',
            'contact_no' => 'nullable|string|max:30',
            'enabled'=>'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('user')->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->contact_no = $request->contact_no;
        $user->enabled = $request->enabled;
        $user->save();
        session()->flash('success', 'Added Successfully');
        return redirect('/admin/users')->with('success', 'Admin Added Successfully');
    }
    // Update user
    public function updateUser(Request $request, User $user)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255'],
            'contact_no' => 'nullable|string|max:30',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->contact_no = $data['contact_no'] ?? null;

        $user->save();

        return redirect('/admin/profile')->with('success', 'Profile updated.');
    }
    //enable or disable user
    public function toggleEnabled($id)
    {
        $user = User::findOrFail($id);

        // Toggle the enabled status
        $user->enabled = !$user->enabled;

        $user->save();

        $status = $user->enabled ? 'enabled' : 'disabled';

        return redirect()->back()->with('success', "User has been {$status} successfully!");
    }

    // Delete user
    public function deleteUser(User $user)
    {
        $this->authorizeUserOrAdmin($user);

        // if you want soft deletes: use SoftDeletes trait in model and call $user->delete()
        $user->delete();

        // if the currently authenticated user deleted themself, log them out
        if (auth()->check() && auth()->id() === $user->id) {
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('success', 'Account deleted.');
        }

        return redirect()->route('home')->with('success', 'User deleted.');
    }

    private function authorizeUserOrAdmin(User $user)
    {
        // Basic authorization check: allow if owner or has is_admin flag
        if (auth()->id() !== $user->id && !(auth()->user()->is_admin ?? false)) {
            abort(403, 'Unauthorized');
        }
    }
}
