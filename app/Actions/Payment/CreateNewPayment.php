<?php

namespace App\Actions\Payment;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateNewPayment
{
    public function create(array $input, Customer $customer)
    {
        Validator::make($input, [
            'amount' => ['required'],
        ])->validate();

        return DB::transaction(function () use ($input,$customer) {
            return $customer->payments()->create(
                ['amount' => $input['amount']]
            );
        });
    }
}
