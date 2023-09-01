<?php

namespace App\Http\Controllers;

use App\Services\CreateTransactionService;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller {
    public function create(Request $request) {
        $createTransactionService = new CreateTransactionService();

        return $createTransactionService->execute($request->all());
    }

    public function capturing(){
        $id = auth()->user()->id;
        // $transactions = Transaction::where("payer_id", $id);
        $transactions = Transaction::all();

        foreach($transactions as &$transaction ){
            $transaction["value"] = floatval($transaction["value"]);
        }

        return response()->json($transactions);
    }
}