<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        return view('backend.permission.index', [
            'title' => 'Permission',
            'permissions' => Permission::all()
        ]);
    }

    public function create(): View
    {
        return view('backend.permission.create', [
            'title' => 'New Permission',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'permission_name' => 'required|string|max:255|unique:permissions,name',
        ]);
        
        Permission::create([
            'name' => $request->permission_name,
        ]);

        return redirect()->route('permission.index')->with('success', 'Permission created successfully');
    }   
}
