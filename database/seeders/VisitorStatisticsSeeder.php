<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = new \Database\Factories\VisitorStatisticsFactory();

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = $factory->definition();
        }

        DB::table('visitor_statistics')->insert($data);
    }
}
