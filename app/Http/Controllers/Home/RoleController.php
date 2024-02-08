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
        $columns = ['name'];

        $roles = Role::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })->paginate($perPage);

        return view('dashboard.role.index', [
            'title' => 'Role',
            'roles' => $roles,
            'perPage' => $perPage,
            'q' => $q,
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
