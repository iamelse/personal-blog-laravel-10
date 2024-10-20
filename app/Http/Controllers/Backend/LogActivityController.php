<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index(Request $request) : View
    {
        $filters = [
            'q' => $request->input('q', ''),
            'perPage' => $request->input('limit', 10),
            'category_id' => $request->input('category_id', null),
            'columns' => ['description'],
            'causer_id' => $request->input('causer_id', null),
            'start_datetime' => $request->input('start_datetime'),
            'end_datetime' => $request->input('end_datetime')
        ];
        
        $activities = $this->_getFilteredActivities($filters);
        $causers = LogActivity::has('causer')
                                ->with('causer:id,name')
                                ->distinct('causer_id')
                                ->get()
                                ->pluck('causer')
                                ->unique('id');

        return view('backend.log_activity.index', [
            'title' => 'Log Activity',
            'activities' => $activities,
            'causers' => $causers
        ]);
    }

    private function _getFilteredActivities($filters)
    {
        return LogActivity::filter($filters);
    }
}
