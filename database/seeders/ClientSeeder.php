<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            'name' => 'Testing 12',
            'slug' => Str::slug('Testing 12'),
            'related_person' => 'person',
        ]);
        Client::insert([
            'name' => 'Test 22',
            'slug' => Str::slug('Test 22'),
            'related_person' => 'person2',
        ]);
        Client::insert([
            'name' => 'Client',
            'slug' => Str::slug('Client'),
            'related_person' => 'person3',
        ]);
    }
}
