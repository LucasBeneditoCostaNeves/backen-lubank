<?php

namespace App\Services;
use App\Models\User;

class CapturingUserService
{
    public function execute()
    {
        $users = User::all();

        foreach($users as &$product ){
            $product["money"] = floatval($product["money"]);
        }

        return response()->json($users);
    }
}