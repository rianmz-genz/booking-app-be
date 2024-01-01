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
    public function testSuccessRegisterAdmin(): void
    {
        User::truncate();
        $response = $this->post('api/auth/register', [
            'email' => 'adrian@gmail.com',
            'password' => 'password',
            'phone' => '0891829182',
            'fullname' => 'adrian aji',
            'role' => 'admin',
            'is_active' => true
        ]);
        Log::info(json_encode($response));
        $response->assertStatus(201)->assertJsonStructure([
            'data' => [
                'id',
                'fullname',
                'role',
                'phone',
                'email'
            ],
            'message',
            'status',
            'code'
        ]);
    }
    public function testSuccessRegisterCustomer(): void
    {
        User::truncate();
        $response = $this->post('api/auth/register', [
            'email' => 'adrian@gmail.com',
            'password' => 'password',
            'phone' => '0891829182',
            'fullname' => 'adrian aji',
            'role' => 'customer',
            'is_active' => true
        ]);
        Log::info(json_encode($response));
        $response->assertStatus(201)->assertJsonStructure([
            'data' => [
                'id',
                'fullname',
                'role',
                'phone',
                'email'
            ],
            'message',
            'status',
            'code'
        ]);
    }
    public function testEmailAlreadyRegistered(): void
    {
        User::truncate();
        $this->seed([UserSeeder::class]);
        $response = $this->post('api/auth/register', [
            'email' => 'test@gmail.com',
            'password' => 'password',
            'phone' => '0891829182',
            'fullname' => 'adrian aji',
        ]);
        $response->assertStatus(400)->assertJsonStructure([
            'data',
            'message',
            'status',
            'code'
        ]);
    }

    public function testLoginSuccess()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'token',
                'user' =>
                [
                    'id',
                    'fullname',
                    'email',
                    'phone',
                    'is_active'
                ],
            ],
            'message',
            'status',
            'code'
        ]);
    }

    public function testLoginUserNotActive()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'not@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(400)->assertJsonStructure([
            'data',
            'message',
            'status',
            'code'
        ]);
    }

    public function testLoginUserNotFound()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'teasasaast@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(404)->assertJsonStructure([
            'data',
            'message',
            'status',
            'code'
        ]);
    }

    public function testLoginWrongPassword()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'aa',
        ]);
        $response->assertStatus(400)->assertJsonStructure([
            'data',
            'message',
            'status',
            'code'
        ]);
    }
}
