<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagePaymentsController extends Controller
{
    public function __invoke(Request $request, $customerId)
    {
        return  view('payments', compact('customerId'));
    }
}
