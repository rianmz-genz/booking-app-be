<?php

namespace Database\Seeders;

use App\Models\StadiumCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadiumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StadiumCategory::create([
            'name' => 'Badminton',
            'logo' => 'logo/badminton'
        ]);
    }
}
