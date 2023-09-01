<?php

namespace App\Services;
use App\Models\User;

class CreateUserService
{
    public function execute(array $data)
    {
        $email = $data['email'];

        $verify = User::where('email', $email)->first();

        $cpf = $data['cpf'];

        $verifyCpf = User::where('cpf', $cpf)->first();

        if ($verify) {
            return response()->json(['error' => 'Email already exists'], 400);
        }

        if ($verifyCpf) {
            return response()->json(['error' => 'Cpf already exists'], 400);
        }

        return User::create($data);
    }
}