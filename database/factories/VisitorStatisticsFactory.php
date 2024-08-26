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
        $browser = $this->faker->word;
        $device = $this->faker->word;
        $os = $this->faker->word;
        $ip = $this->faker->ipv4;

        $osInfo = json_encode([
            'name' => $this->faker->word,
            'version' => $this->faker->word,
        ]);

        $clientInfo = json_encode([
            'name' => $this->faker->word,
            'version' => $this->faker->word,
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