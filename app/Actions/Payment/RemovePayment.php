<?php

namespace App\Actions\Payment;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class RemovePayment
{
    public function remove($customerId): void
    {
        DB::transaction(function () use ($customerId) {
            $user = Payment::find($customerId);
            $user->delete();
        });
    }
}
