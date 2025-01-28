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
            'name_jp' => '株式会社あいホーム',
            'name_en' => 'Ai Home',
            'slug' => Str::slug('Testing 12'),
        ]);
        Client::insert([
            'name_jp' => 'テスト',
            'name_en' => 'Test',
            'slug' => Str::slug('Test 22'),
        ]);
        Client::insert([
            'name_jp' => 'アイワホーム株式会社',
            'name_en' => 'Aiwa Home',
            'slug' => Str::slug('Client'),
        ]);
    }
}
