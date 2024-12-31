<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInitialSetup
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $tableNames = DB::connection()->getDoctrineSchemaManager()->listTableNames();
            $usersTable = DB::table('users')->get();

            $totalTables = count($tableNames);
            $totalUserData = count($usersTable);

            if ($totalTables == 0 || $totalUserData == 0) {
                return redirect()->route('initial.setup');
            }
            return $next($request);
        } catch (QueryException $e) {
            return redirect()->route('initial.setup');
        }
    }
}
