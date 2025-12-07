<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ];
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Email not found',
            ];
        }

        if (!Hash::check($data['password'], $user->password)) {
            return [
                'status' => false,
                'message' => 'Invalid Credentials',
            ];
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'status' => true,
            'message' => 'Login successfully',
            'token' => $token,
            'user' => $user,
        ];
    }
}
