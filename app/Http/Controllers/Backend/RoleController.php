<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
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

        activity('role_management')
            ->causedBy(Auth::user())
            ->log('Accessed roles index.');

        return view('backend.role.index', [
            'title' => 'Role',
            'roles' => $roles,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function show(Role $role): View
    {
        activity('role_management')
            ->causedBy(Auth::user())
            ->log("Viewed role details: {$role->name}");

        return view('backend.role.show', [
            'title' => 'Role Detail',
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function updateRolePermissions(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'permissions' => 'array',
        ]);

        $selectedPermissions = $request->input('permissions', []);
        $permissionsToGive = Permission::whereIn('id', $selectedPermissions)->get();
        
        $role->syncPermissions($permissionsToGive);

        activity('role_management')
            ->causedBy(Auth::user())
            ->log("Updated permissions for role: {$role->name}");

        return redirect()->back()->with('success', 'Permissions saved successfully');
    }
}
