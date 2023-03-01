<?php

namespace App\Actions\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdatePayment
{
    public function update(array $input, Payment $payment)
    {
        Validator::make($input, [
            'amount' => ['required'],
        ])->validate();

        return DB::transaction(function () use ($input,$payment) {
            return $payment->update(
                ['amount' => $input['amount']]
            );
        });
    }
}
