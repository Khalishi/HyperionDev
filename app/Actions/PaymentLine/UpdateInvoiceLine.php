<?php

namespace App\Actions\PaymentLine;

use App\Models\InvoiceLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateInvoiceLine
{
    public function update(array $input, InvoiceLine $line)
    {
        Validator::make($input, [
            'amount' => ['required'],
            'description' => ['required', 'string'],
        ])->validate();

        return DB::transaction(function () use ($input, $line) {
            return tap($line->update([
                'amount' => $input['amount'],
                'description' => $input['description'],
            ]));
        });
    }
}
