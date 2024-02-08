<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');

        $roles = Role::where('name', 'LIKE', "%$q%")->paginate($perPage);

        return view('dashboard.role.index', [
            'title' => 'Role',
            'roles' => $roles,
        ]);
    }

    public function show(Role $role)
    {
        return view('dashboard.role.show', [
            'title' => 'Role Detail',
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function updateRolePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
        ]);

        $selectedPermissions = $request->input('permissions', []);
        $permissionsToGive = Permission::whereIn('id', $selectedPermissions)->get();
        
        $role->syncPermissions($permissionsToGive);

        return redirect()->back()->with('success', 'Permissions saved successfully');
    }
}
