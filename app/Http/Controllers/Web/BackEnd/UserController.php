<?php

namespace App\Http\Controllers\Web\BackEnd;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request): View | RedirectResponse
    {
        Gate::authorize(PermissionEnum::READ_USER->value);

        $allowedFilterFields = ['name', 'username', 'email'];
        $allowedSortFields = ['name', 'username', 'email', 'email_verified_at', 'created_at', 'updated_at'];
        $limits = [10, 25, 50, 100];

        $redirect = $this->_validateFilter(request()->query('filter', []), $allowedFilterFields);
        if ($redirect) {
            return $redirect;
        }

        $users = QueryBuilder::for(User::class)
                ->defaultSort('name')
                ->allowedFilters($allowedFilterFields)
                ->allowedSorts($allowedSortFields)
                ->paginate($request->query('limit', 10))
                ->appends(request()->query())
                ->onEachSide(1);

        return view('pages.user.index', [
            'title' => 'User',
            'users' => $users,
            'allowedFilterFields' => $allowedFilterFields,
            'allowedSortFields' => $allowedSortFields,
            'limits' => $limits
        ]);
    }

    /**
     * Validate allowed filters fields.
     */
    private function _validateFilter(array $filters, array $allowedFilterFields): RedirectResponse | NULL
    {
        $validFilters = array_intersect_key($filters, array_flip($allowedFilterFields));

        if (count($validFilters) !== count($filters)) {
            return redirect()->route('be.user.index', array_merge(request()->except('filter'), ['filter' => $validFilters]));
        }

        return null;
    }
}
