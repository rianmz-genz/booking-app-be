<?php

namespace Database\Seeders;

use App\Models\Stadium;
use App\Models\StadiumCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');
        $stadiumCategory = StadiumCategory::all()->first();
        $data = [
            'name' => 'Stadium Name',
            'address' => 'Stadium Address',
            'phone' => '123456789',
            'description' => 'Stadium Description',
            'images' => [$image1, $image2],
            'open_at' => '2024-01-01 12:00:00',
            'closed_at' => '2024-01-01 12:00:00',
            'stadium_category_id' => $stadiumCategory->id,
        ];
        Stadium::create($data);
    }
}
