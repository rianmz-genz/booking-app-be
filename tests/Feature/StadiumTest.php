<?php

namespace Tests\Feature;

use App\Models\StadiumCategory;
use Database\Seeders\StadiumCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class StadiumTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStadiumCreateSuccess()
    {
        $this->seed([StadiumCategorySeeder::class]);
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');
        $stadiumCategory = StadiumCategory::all()->first();
        $data = [
            'name' => 'Stadium Name',
            'address' => 'Stadium Address',
            'phone' => '123456789',
            'description' => 'Stadium Description',
            'images' => [$image1, $image2],
            'open_at' => true,
            'closed_at' => '2024-01-01 12:00:00',
            'stadium_category_id' => $stadiumCategory->id,
        ];

        $response = $this->post('/api/stadiums', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'Success create stadium',
            ]);
    }
}
