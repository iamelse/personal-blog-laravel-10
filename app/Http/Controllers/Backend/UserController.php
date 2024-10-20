<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['name'];

        $users = User::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })->paginate($perPage);

        activity('user_management')
            ->causedBy(Auth::user())
            ->log('Accessed user index.');

        return view('backend.user.index', [
            'title' => 'User',
            'users' => $users,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View
    {
        $roles = Role::all();

        activity('user_management')
            ->causedBy(Auth::user())
            ->log('Accessed create user page.');

        return view('backend.user.create', [
            'title' => 'New User',
            'roles' => $roles
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role_id' => 'required',
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->input('password'));

        $user = User::create($userData);
        $role = Role::findById($request->input('role_id'));
        $user->assignRole($role->name);

        activity('user_management')
            ->causedBy(Auth::user())
            ->log("Created new user: {$user->name}");

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        $roles = Role::all();

        activity('user_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for user: {$user->name}");

        return view('backend.user.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'role_id' => 'required',
        ]);

        $userData = $request->all();

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        } else {
            unset($userData['password']);
        }

        $user->update($userData);
        $role = Role::find($request->input('role_id'));

        if ($role) {
            $user->syncRoles([$role->name]);
        }

        activity('user_management')
            ->causedBy(Auth::user())
            ->log("Updated user: {$user->name}");

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        activity('user_management')
            ->causedBy(Auth::user())
            ->log("Deleted user: {$user->name}");

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
