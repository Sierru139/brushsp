<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->create([
            'name' => 'Client 1',
            'slug' => 'Client',
        ]);
        Client::factory()->create([
            'name' => 'Client 2',
            'slug' => 'Client',
        ]);
        Client::factory()->create([
            'name' => 'Client 3',
            'slug' => 'Client',
        ]);
    }
}
