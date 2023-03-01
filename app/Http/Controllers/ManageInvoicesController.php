<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageInvoicesController extends Controller
{
    public function __invoke(Request $request, $customerId)
    {
        return  view('invoices', compact('customerId'));
    }
}
