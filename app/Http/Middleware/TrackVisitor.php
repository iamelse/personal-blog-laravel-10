<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $browser = $this->_getBrowser($userAgent);
        $device = $this->_getDevice($userAgent);
        $os = $this->_getOS($userAgent);
        $country = $this->_getCountry($ip);

        $date = now()->toDateString();
        DB::table('visitor_statistics')
            ->updateOrInsert(
                [
                    'date' => $date,
                    'country' => $country,
                    'browser' => $browser,
                    'device' => $device,
                    'os' => $os,
                    'ip' => $ip,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

        return $next($request);
    }

    private function _getBrowser($userAgent)
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgent);
        return $agent->browser();
    }

    private function _getDevice($userAgent)
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgent);
        return $agent->device() ?: 'Unknown';
    }

    private function _getOS($userAgent)
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgent);
        return $agent->platform();
    }

    private function _getCountry($ip)
    {
        $accessKey = env('IPINFO_TOKEN');

        if (!env('RUN_IPINFO')) {
            return 'Need to activate IPinfo in your env!';
        }

        try {
            $response = Http::get("http://ipinfo.io/{$ip}?token={$accessKey}");
            $data = $response->json();

            return $data['country'] ?? 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
}