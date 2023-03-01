<?php

namespace App\Actions\PaymentLine;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateNewInvoiceLine
{
    public function create(array $input, Invoice $invoice)
    {
        Validator::make($input, [
            'amount' => ['required'],
            'description' => ['required', 'string'],
        ])->validate();

        return DB::transaction(function () use ($input,$invoice) {
            return tap($invoice->invoiceLines()->create(
                [
                    'amount' => $input['amount'],
                    'description' => $input['description']
                ]
            ));
        });
    }
}
