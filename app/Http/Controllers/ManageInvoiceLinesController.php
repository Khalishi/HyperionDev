<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class ManageInvoiceLinesController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice)
    {
        return  view('invoice-lines', compact('invoice'));
    }
}
