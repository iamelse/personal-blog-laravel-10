<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorStatisticsFactory extends Factory
{
    protected $model = \Illuminate\Database\Eloquent\Model::class;

    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 week', 'now');
        $country = $this->faker->countryCode();
        
        $browsers = ['Chrome', 'Firefox', 'Opera', 'Safari', 'Edge', 'Internet Explorer'];
        $devices = ['Desktop', 'Mobile', 'Tablet'];
        $operatingSystems = ['Windows', 'macOS', 'Linux', 'Android', 'iOS'];
        
        $browser = $this->faker->randomElement($browsers);
        $device = $this->faker->randomElement($devices);
        $os = $this->faker->randomElement($operatingSystems);
        $ip = $this->faker->ipv4;

        $osVersions = [
            'Windows' => '10',
            'macOS' => '11.4',
            'Linux' => '5.10',
            'Android' => '11',
            'iOS' => '14.6',
        ];

        $clientVersions = [
            'Chrome' => '91.0',
            'Firefox' => '89.0',
            'Opera' => '77.0',
            'Safari' => '14.1',
            'Edge' => '91.0',
            'Internet Explorer' => '11.0',
        ];

        $osInfo = json_encode([
            'name' => $os,
            'version' => $osVersions[$os] ?? $this->faker->word,
        ]);

        $clientInfo = json_encode([
            'name' => $browser,
            'version' => $clientVersions[$browser] ?? $this->faker->word,
        ]);

        return [
            'date' => $date,
            'country' => $country,
            'browser' => $browser,
            'device' => $device,
            'os' => $os,
            'ip' => $ip,
            'full_os_info' => $osInfo,
            'full_client_info' => $clientInfo,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}