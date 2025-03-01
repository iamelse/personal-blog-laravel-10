<?php

namespace App\Http\Controllers\Web\BackEnd;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View | RedirectResponse
    {
        Gate::authorize(PermissionEnum::READ_ROLE);

        $allowedFilterFields = ['name'];
        $allowedSortFields = ['name', 'created_at', 'updated_at'];

        $redirect = $this->_validateFilter(request()->query('filter', []), $allowedFilterFields);
        if ($redirect) {
            return $redirect;
        }

        $roles = QueryBuilder::for(Role::class)
                ->defaultSort('name')
                ->allowedFilters($allowedFilterFields)
                ->allowedSorts($allowedSortFields)
                ->paginate(10);

        return view('pages.role.index', [
            'title' => 'Role and Permission',
            'roles' => $roles,
            'allowedFilterFields' => $allowedFilterFields,
            'allowedSortFields' => $allowedSortFields
        ]);
    }

    /**
     * Validate allowed filters fields.
     */
    private function _validateFilter(array $filters, array $allowedFilterFields): RedirectResponse | NULL
    {
        $validFilters = array_intersect_key($filters, array_flip($allowedFilterFields));

        if (count($validFilters) !== count($filters)) {
            return redirect()->route('be.role.and.permission.index', array_merge(request()->except('filter'), ['filter' => $validFilters]));
        }

        return null;
    }
}
