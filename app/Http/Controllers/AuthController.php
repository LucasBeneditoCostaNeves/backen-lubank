<?php

namespace App\Http\Controllers;


use App\Services\LoginService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginService = new LoginService();

        return $loginService->execute($request->all());
    }
}