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
            'name_jp' => 'Testing 12',
            'name_en' => 'person',
            'slug' => Str::slug('Testing 12'),
        ]);
        Client::insert([
            'name_jp' => 'Test 22',
            'name_en' => 'person2',
            'slug' => Str::slug('Test 22'),
        ]);
        Client::insert([
            'name_jp' => 'Client',
            'name_en' => 'person3',
            'slug' => Str::slug('Client'),
        ]);
    }
}
