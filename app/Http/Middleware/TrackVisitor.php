<?php

namespace App\Http\Middleware;

use App\Enums\PostStatus;
use App\Models\Post;
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
        $slug = $request->route('slug');
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $clientHints = ClientHints::factory($_SERVER);

        $deviceDetector = new DeviceDetector($userAgent, $clientHints);
        $deviceDetector->parse();

        $ip = $request->ip();
        $browser = $this->_getBrowser($userAgent);
        $device = $this->_getDevice($userAgent);
        $os = $this->_getOS($userAgent);
        $country = $this->_getCountry($ip);

        // Check if post exists and its status is not 'draft'
        if ($slug) {
            $post = Post::where('slug', $slug)->first();

            if ($post && $post->status !== PostStatus::DRAFT->value) {
                // Track the visitor if the post is not a draft
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
            }
        }

        return $next($request);
    }

    private function _getBrowser($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return ucfirst($deviceDetector->getClient()['name'] ?? 'Unknown');
    }

    private function _getDevice($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return ucfirst($deviceDetector->getDeviceName() ?? 'Unknown');
    }

    private function _getOS($userAgent)
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();
        return ucfirst($deviceDetector->getOs()['name'] ?? 'Unknown');
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