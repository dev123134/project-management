<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payable;
use Illuminate\Support\Facades\Auth;


class PayableController extends Controller
{
    public function index(Request $request)
    {
        $payables = Payable::when($request->search, function ($query) use ($request) {

            $query->where('payable_number', 'like', '%' . $request->search . '%')
                ->orWhere('vendor_name', 'like', '%' . $request->search . '%');
        })
            ->oldest()
            ->paginate(10);

        return view('finance.payables.index', compact('payables'));
    }

   public function create()
{
    $lastPayable = Payable::latest()->first();

    if ($lastPayable) {

        $number = (int) substr($lastPayable->payable_number, 4) + 1;

    } else {

        $number = 1;

    }

    $payableNumber = 'PAY-' . str_pad($number, 4, '0', STR_PAD_LEFT);

    return view('finance.payables.create', compact('payableNumber'));
}
    public function store(Request $request)
{
    $request->validate([

        'payable_number' => 'required|unique:payables,payable_number',

        'payable_type' => 'required',

        'vendor_name' => 'required|string|max:255',

        'amount' => 'required|numeric|min:1',

        'payment_date' => 'required|date',

        'due_date' => 'required|date|after_or_equal:payment_date',

        'status' => 'required',

        'notes' => 'nullable',

    ]);

    Payable::create([

        'payable_number' => $request->payable_number,

        'payable_type' => $request->payable_type,

        'vendor_name' => $request->vendor_name,

        'amount' => $request->amount,

        'payment_date' => $request->payment_date,

        'due_date' => $request->due_date,

        'status' => $request->status,

        'notes' => $request->notes,

        'created_by' => Auth::id(),

    ]);

    return redirect()
            ->route('payables.index')
            ->with('success', 'Payable created successfully.');
}

    public function show(Payable $payable)
{
    $payable->load('creator');

    return view('finance.payables.show', compact('payable'));
}

  public function edit(Payable $payable)
{
    return view('finance.payables.edit', compact('payable'));
}

   public function update(Request $request, Payable $payable)
{
    $request->validate([

        'payable_number' => 'required|unique:payables,payable_number,' . $payable->id,

        'payable_type' => 'required',

        'vendor_name' => 'required|string|max:255',

        'amount' => 'required|numeric|min:1',

        'payment_date' => 'required|date',

        'due_date' => 'required|date|after_or_equal:payment_date',

        'status' => 'required',

        'notes' => 'nullable',

    ]);

    $payable->update([

        'payable_number' => $request->payable_number,

        'payable_type' => $request->payable_type,

        'vendor_name' => $request->vendor_name,

        'amount' => $request->amount,

        'payment_date' => $request->payment_date,

        'due_date' => $request->due_date,

        'status' => $request->status,

        'notes' => $request->notes,

    ]);

    return redirect()
            ->route('payables.index')
            ->with('success', 'Payable updated successfully.');
}

    public function destroy(Payable $payable)
{
    $payable->delete();

    return redirect()
            ->route('payables.index')
            ->with('success', 'Payable deleted successfully.');
}   
}
