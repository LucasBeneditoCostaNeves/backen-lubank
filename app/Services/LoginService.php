<?php

namespace App\Services;

use App\Models\User;

class LoginService
{
    public function execute(array $data)
    {
        if (!$token = auth()->attempt($data)) {
            return response()->json(['errors' => "Email ou senha incorretos"], 401);
        }

        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }
}