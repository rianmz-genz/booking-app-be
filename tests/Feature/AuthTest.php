<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessRegister(): void
    {
        User::truncate();
        $response = $this->post('api/auth/register', [
            'email' => 'adrian@gmail.com',
            'password' => 'password',
            'name' => 'adrian aji'
        ]);
        Log::info(json_encode($response));
        $response->assertStatus(201)->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email'
            ],
            'message',
            'status',
            'code'
        ]);
    }

    public function testLoginSuccess()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'adrian@gmail.com',
            'password' => 'password',
        ]);
        Log::info(json_encode($response));
        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'token',
                'user' =>
                [
                    'id',
                    'name',
                    'email'
                ],
            ],
            'message',
            'status',
            'code'
        ]);
    }
}
