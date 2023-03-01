<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateInvoice
{
    public function update(array $input, Invoice $invoice)
    {
        Validator::make($input, [
            'description' => ['required', 'string'],
        ])->validate();

        return DB::transaction(function () use ($input, $invoice) {
            return tap($invoice->update([
                'description' => $input['description'],
            ]));
        });
    }
}
