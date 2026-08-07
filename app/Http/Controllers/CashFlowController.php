<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Payable;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
public function index()
{
    $totalInvoice = Invoice::sum('grand_total');

    $totalReceived = Payment::sum('amount');

    $totalPayables = Payable::sum('amount');

    $netCashFlow = $totalReceived - $totalPayables;

    return view('finance.cashflow.index', compact(

        'totalInvoice',

        'totalReceived',

        'totalPayables',

        'netCashFlow'

    ));
}}
