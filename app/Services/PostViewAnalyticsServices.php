<?php

namespace App\Services;

use App\Models\PostView;
use Illuminate\Support\Facades\DB;

class PostViewAnalyticsServices
{
    /**
     * Get total views for a given period.
     *
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public function getTotalViewsForPeriod(string $startDate, string $endDate): int
    {
        return PostView::whereBetween('view_date', [$startDate, $endDate])
                       ->sum('view_count');
    }

    /**
     * Get total views for today.
     *
     * @return int
     */
    public function getViewsForToday(): int
    {
        $today = now()->startOfDay()->toDateString();
        return $this->getTotalViewsForPeriod($today, $today);
    }

    /**
     * Get total views for the current week.
     *
     * @return int
     */
    public function getViewsForWeek(): int
    {
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();
        return $this->getTotalViewsForPeriod($startOfWeek, $endOfWeek);
    }

    /**
     * Get total views for the current month.
     *
     * @return int
     */
    public function getViewsForMonth(): int
    {
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        return $this->getTotalViewsForPeriod($startOfMonth, $endOfMonth);
    }

    /**
     * Get total views for the current year.
     *
     * @return int
     */
    public function getViewsForYear(): int
    {
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();
        return $this->getTotalViewsForPeriod($startOfYear, $endOfYear);
    }

    /**
     * Get historical views data for the last 7 days.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getViewsHistoriesForWeek()
    {
        $data = PostView::select(DB::raw('view_date, SUM(view_count) as total_views'))
            ->whereBetween('view_date', [now()->subDays(7)->toDateString(), now()->toDateString()])
            ->groupBy('view_date')
            ->orderBy('view_date', 'asc')
            ->get();

        return $data;
    }
}