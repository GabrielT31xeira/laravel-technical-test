<?php

namespace App\Http\Services\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthServices {
    public function register($user)
    {
        try {
            $user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function login($data)
    {
        try {
            $validUser = User::where('email', $data['email'])->first();

            if (!$data || ! Hash::check($data['password'], $validUser->password)) {
                throw ValidationException::withMessages(['email' => ['Credenciais inválidas.']]);
            }

            $token = $validUser->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function profile($id)
    {
        try {
            $user = DB::table('users')->where('id', $id)->first();
            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout($data)
    {
        try {
            $data->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout efetuado com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
