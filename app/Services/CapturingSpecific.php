<?php

namespace App\Services;
use App\Models\User;

class CapturingSpecificService
{
    public function execute()
    {
        $id = auth()->user()->id;
        $users = User::all();

        foreach($users as &$product ){
            $product["money"] = floatval($product["money"]);
        }

        return response()->json($users);
    }
}