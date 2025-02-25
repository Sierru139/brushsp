<?php

namespace Database\Seeders;

use App\Models\ProjectCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectCode::insert([
            'code' => 'AA',
        ]);
        ProjectCode::insert([
            'code' => 'AB',
        ]);
        ProjectCode::insert([
            'code' => 'AC',
        ]);
        ProjectCode::insert([
            'code' => 'BA',
        ]);
    }
}
