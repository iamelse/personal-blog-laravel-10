<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            View::share([
                'notifications' => $user->notifications()->latest()->take(10)->get(),
                'unreadCount' => $user->unreadNotifications()->count(),
            ]);
        }

        return $next($request);
    }
}