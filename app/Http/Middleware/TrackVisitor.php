<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $clientHints = ClientHints::factory($_SERVER);

        $deviceDetector = new DeviceDetector($userAgent, $clientHints);

        $deviceDetector->parse();

        $ip = $request->ip();
        //$userAgent = $request->header('User-Agent');

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
                    'full_os_info' => json_encode($deviceDetector->getOs()),
                    'full_client_info'=> json_encode($deviceDetector->getClient()),
                ],
                [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

        return $next($request);
    }

    private function _getBrowser($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return $deviceDetector->getClient()['name'] ?? 'Unknown';
    }

    private function _getDevice($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return $deviceDetector->getDeviceName() ?? 'Unknown';
    }

    private function _getOS($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return $deviceDetector->getOs()['name'] ?? 'Unknown';
    }

    private function _getCountry($ip)
    {
        $accessKey = env('IPINFO_TOKEN');

        if (!env('RUN_IPINFO')) {
            return 'IPinfo service is not activated.';
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