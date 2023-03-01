<?php

namespace App\Actions\Invoice;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateNewInvoice
{
    public function create(array $input, Customer $customer)
    {
        Validator::make($input, [
            'description' => ['required', 'string'],
        ])->validate();

        return DB::transaction(function () use ($input,$customer) {
            return tap($customer->invoices()->create(
                [
                    'amount' => 0,
                    'description' => $input['description']
                ]
            ));
        });
    }
}
