<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity;

class LogActivity extends Activity
{
    use HasFactory;

    public $guarded = ['id'];

    protected $table = 'activity_log';

    public function scopeFilter($query, $filters = [])
    {
        $q = $filters['q'] ?? null;
        $perPage = $filters['perPage'] ?? 10;
        $columns = $filters['columns'] ?? [];
        $causer_id = $filters['causer_id'] ?? null;
        $start_datetime = $filters['start_datetime'] ?? null;
        $end_datetime = $filters['end_datetime'] ?? null;

        return $query
            ->when($causer_id, function ($query) use ($causer_id) {
                $query->where('causer_id', $causer_id);
            })
            ->when($start_datetime, function ($query) use ($start_datetime) {
                $query->where('created_at', '>=', $start_datetime);
            })
            ->when($end_datetime, function ($query) use ($end_datetime) {
                $query->where('created_at', '<=', $end_datetime);
            })
            ->when($q, function ($query) use ($q, $columns) {
                $query->where(function ($subquery) use ($q, $columns) {
                    foreach ($columns as $column) {
                        $subquery->orWhere($column, 'LIKE', "%$q%");
                    }
                });
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }
}
