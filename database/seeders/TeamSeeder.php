<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            'name' => 'Flex',
            'slug' => Str::slug('Flex'),
        ]);
        Team::insert([
            'name' => 'Sachi',
            'slug' => Str::slug('Sachi'),
        ]);
        Team::insert([
            'name' => 'Wakuwaku',
            'slug' => Str::slug('Wakuwaku'),
        ]);
        Team::insert([
            'name' => 'Subscription',
            'slug' => Str::slug('Subscription'),
        ]);
        Team::insert([
            'name' => 'Semarang',
            'slug' => Str::slug('Semarang'),
        ]);
    }
}
