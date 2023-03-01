<?php

namespace App\Actions\PaymentLine;

use App\Models\InvoiceLine;
use Illuminate\Support\Facades\DB;

class RemoveInvoiceLine
{
    public function remove($invoiceLine): void
    {
        DB::transaction(function () use ($invoiceLine) {
            $line = InvoiceLine::find($invoiceLine);
            $line->delete();
        });
    }
}
