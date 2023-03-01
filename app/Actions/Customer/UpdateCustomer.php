<?php

namespace App\Actions\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UpdateCustomer
{
    public function update(array $input, Customer $customer)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255', 'min:5'],
        ])->validate();

        return DB::transaction(function () use ($input,$customer) {
            return tap($customer->update([
                'name' => $input['name'],
                'username' => $input['username'],
                'address' => $input['address'],
                'password' => $input['password'],
            ]));
        });
    }
}
