<?php

namespace App\Http\Controllers;

use App\Services\{CreateUserService, CapturingUserService, CreateDepositService, CapturingSpecificService};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $createdUserService = new CreateUserService();
        return $createdUserService->execute($request->all());
    }

    public function capturing(){
        $createdUserService = new CapturingUserService();
        return $createdUserService->execute();
    }

    public function deposit(Request $request) {
        $createDepositService = new CreateDepositService();

        return $createDepositService->execute(
            auth()->user()->id,
            $request->value
        );
    }

    public function specific(){
        $createdUserService = new CapturingSpecificService();
        return $createdUserService->execute();
    }
}