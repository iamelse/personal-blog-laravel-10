<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('dashboard.permission.index', [
            'title' => 'Permission',
            'permissions' => Permission::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.permission.create', [
            'title' => 'New Permission',
        ]);
    }

    public function store(Request $request)
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
