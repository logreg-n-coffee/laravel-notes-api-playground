<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();

        // Check if a user with the specified email exists
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // create an auth_token for the user as specified in Sanctum's docs
        $token = $user->createToken('auth_token')->plainTextToken;

        // return the token and the user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $validatedData = $request->validated();
        // Check if a user with the specified email exists
        $user = User::where('email', $validatedData['email'])->first();

        // If a user with the email was found - check if the specified password
        // belongs to this user
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // create an auth_token for the user as specified in Sanctum's docs
        $token = $user->createToken('auth_token')->plainTextToken;

        // return the token and the user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
