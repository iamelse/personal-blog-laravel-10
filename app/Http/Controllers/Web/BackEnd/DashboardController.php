<?php

namespace App\Http\Controllers\Web\BackEnd;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        Gate::authorize(PermissionEnum::DASHBOARD_INDEX->value);

        return view('pages.dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }
}
