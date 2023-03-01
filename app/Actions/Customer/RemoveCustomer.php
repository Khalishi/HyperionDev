<?php

namespace App\Actions\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class RemoveCustomer
{
    public function remove($customerId): void
    {
        DB::transaction(function () use ($customerId) {
            $customer = Customer::find($customerId);
            $customer->delete();
        });
    }
}
