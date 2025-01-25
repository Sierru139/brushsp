<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::factory()->create([
            'name' => 'Flex',
            'slug' => 'Flex',
        ]);
        Team::factory()->create([
            'name' => 'Sachi',
            'slug' => 'Sachi',
        ]);
        Team::factory()->create([
            'name' => 'Wakuwaku',
            'slug' => 'Wakuwaku',
        ]);
        Team::factory()->create([
            'name' => 'Subscription',
            'slug' => 'Subscription',
        ]);
        Team::factory()->create([
            'name' => 'Semarang',
            'slug' => 'Semarang',
        ]);

    }
}
