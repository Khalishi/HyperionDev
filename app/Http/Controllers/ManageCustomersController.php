<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageCustomersController extends Controller
{

    public function __invoke(Request $request)
    {
        return  view('customers');
    }
}
