<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;

class CreateTransactionService {
    public function execute(array $data) {
        $userPayer = $this->findUser($data['payer']);

        if($userPayer->money < $data['value']) {
            throw new AppError('Saldo insuficiente para transação', 400);
        }

        $userPayee = $this->findUser($data['payee']);

        $userPayer->money -= $data['value'];
        $userPayee->money += $data['value'];

        $userPayer->save();
        $userPayee->save();


        return Transaction::create([
            'payee_id' => $userPayee->id,
            'payer_id' => $userPayer->id,
            'value' => $data['value']
        ]);
    }

    private function findUser(string $variable) {
        $verifyCpf = User::where('cpf', $variable)->first();
        
        if($verifyCpf){
            return $verifyCpf;
        }

        $verifyPhone = User::where('phone', $variable)->first();

        if($verifyPhone){
            return $verifyPhone;
        }

        $user = User::find($variable);

        if(is_null($user)) {
            throw new AppError("Usuário {$variable} não encontrado", 404);
        }

        return $user;
    }
}