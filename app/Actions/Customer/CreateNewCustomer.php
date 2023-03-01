<?php

namespace App\Actions\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateNewCustomer
{
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:operators'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255', 'min:5'],
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(Customer::create([
                'name' => $input['name'],
                'username' => $input['username'],
                'address' => $input['address'],
                'password' => $input['password'],
                'balance' => 0,
            ]));
        });
    }
}
