<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('dashboard.role.index', [
            'title' => 'Role',
            'roles' => Role::all()
        ]);
    }
}
