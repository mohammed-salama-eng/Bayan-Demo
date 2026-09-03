<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $user->syncRoles($validated['roles']);

        return redirect()->route('admin.users.index')->with('success', __('User roles updated successfully.'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', __('You cannot delete your own account.'));
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('User deleted successfully.'));
    }
}
