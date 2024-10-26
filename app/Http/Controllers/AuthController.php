<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use Helper;

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $existingUserCount = User::where('email', $data['email'])->count();
        if ($existingUserCount > 0) {
            return $this->error_response( 'Email already taken', 400);
        }
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $this->success_response(new UserResource($user), 'Success to register user', 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            return $this->error_response('User not found', 404);
        }
        if (!Hash::check($data['password'], $user->password)) {
            return $this->error_response('Password is wrong', 400);
        }
        if (!$user->is_active) {
            return $this->error_response('User not active', 400);
        }
        $token = $user->createToken('login', ['role:all'])->plainTextToken;
        $response = [
            'token' => $token,
            'user' => new UserResource($user)
        ];
        return $this->success_response($response, 'Success to login');
    }
}
