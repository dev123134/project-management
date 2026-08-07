<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
   public function index(Request $request)
{
    $payments = Payment::with(['invoice', 'receiver'])

        ->when($request->search, function ($query) use ($request) {

            $query->where('transaction_id', 'like', '%' . $request->search . '%')

                ->orWhereHas('invoice', function ($q) use ($request) {

                    $q->where('invoice_number', 'like', '%' . $request->search . '%');

                });

        })

        ->latest()

        ->paginate(10);

    return view('finance.payments.index', compact('payments'));
}

    public function create()
    {
        $invoices = Invoice::select(
            'id',
            'invoice_number',
            'grand_total',
            'status'
        )
            ->orderBy('invoice_number')
            ->get();

        return view('finance.payments.create', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id'       => 'required|exists:invoices,id',
            'payment_date'     => 'required|date',
            'payment_method'   => 'required|string|max:100',
            'transaction_id'   => 'nullable|string|max:255',
            'amount'           => 'required|numeric|min:1',
            'notes'            => 'nullable|string',
        ]);

        // Invoice શોધો
        $invoice = Invoice::findOrFail($request->invoice_id);

        // અત્યાર સુધીનું Payment
        $alreadyPaid = Payment::where('invoice_id', $invoice->id)
            ->sum('amount');

        // કુલ Payment (જૂનું + નવું)
        $totalPaid = $alreadyPaid + $request->amount;

        // Remaining Balance
        $remaining = $invoice->grand_total - $totalPaid;

        // Over Payment અટકાવો
        if ($remaining < 0) {

            return back()
                ->withInput()
                ->with('error', 'Payment amount exceeds remaining balance.');
        }

        // Payment Save
        Payment::create([

            'invoice_id'      => $invoice->id,

            'payment_date'    => $request->payment_date,

            'payment_method'  => $request->payment_method,

            'transaction_id'  => $request->transaction_id,

            'amount'          => $request->amount,

            'notes'           => $request->notes,

            'received_by'     => Auth::id(),

        ]);

        // Invoice Status Update
        if ($totalPaid == 0) {

            $invoice->status = 'Draft';
        } elseif ($totalPaid < $invoice->grand_total) {

            $invoice->status = 'Partial';
        } else {

            $invoice->status = 'Paid';
        }

        $invoice->save();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment received successfully.');
    }


    public function getInvoiceDetails(Invoice $invoice)
    {
        $paymentId = request('payment_id');

        $alreadyPaid = Payment::where('invoice_id', $invoice->id)
            ->when($paymentId, function ($query) use ($paymentId) {
                $query->where('id', '!=', $paymentId);
            })
            ->sum('amount');

        $remainingBalance = $invoice->grand_total - $alreadyPaid;

        return response()->json([
            'invoice_total'     => $invoice->grand_total,
            'already_paid'      => $alreadyPaid,
            'remaining_balance' => $remainingBalance,
            'status'            => $invoice->status,
        ]);

        $remainingBalance = $invoice->grand_total - $alreadyPaid;

        return response()->json([

            'invoice_total'     => $invoice->grand_total,

            'already_paid'      => $alreadyPaid,

            'remaining_balance' => $remainingBalance,

            'status'            => $invoice->status,

        ]);
    }


    public function show(Payment $payment)
    {
        $payment->load([
            'invoice.project',
            'receiver'
        ]);

        return view('finance.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $invoices = Invoice::orderBy('invoice_number')->get();

        return view('finance.payments.edit', compact(
            'payment',
            'invoices'
        ));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'invoice_id'      => 'required|exists:invoices,id',
            'payment_date'    => 'required|date',
            'payment_method'  => 'required',
            'transaction_id'  => 'nullable|string|max:255',
            'amount'          => 'required|numeric|min:1',
            'notes'           => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        // હાલના payment સિવાયના બધા payment નો total
        $alreadyPaid = Payment::where('invoice_id', $invoice->id)
            ->where('id', '!=', $payment->id)
            ->sum('amount');

        $totalPaid = $alreadyPaid + $request->amount;

        $remaining = $invoice->grand_total - $totalPaid;

        if ($remaining < 0) {

            return back()
                ->withInput()
                ->with('error', 'Payment amount exceeds remaining balance.');
        }

        $payment->update([

            'invoice_id'      => $request->invoice_id,

            'payment_date'    => $request->payment_date,

            'payment_method'  => $request->payment_method,

            'transaction_id'  => $request->transaction_id,

            'amount'          => $request->amount,

            'notes'           => $request->notes,

        ]);

        // Invoice Status Update
        if ($totalPaid == 0) {

            $invoice->status = 'Draft';
        } elseif ($totalPaid < $invoice->grand_total) {

            $invoice->status = 'Partial';
        } else {

            $invoice->status = 'Paid';
        }

        $invoice->save();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $invoice = $payment->invoice;

        // Delete Payment
        $payment->delete();

        // Remaining Payments Total
        $totalPaid = Payment::where('invoice_id', $invoice->id)
            ->sum('amount');

        // Update Invoice Status
        if ($totalPaid <= 0) {

            $invoice->status = 'Draft';
        } elseif ($totalPaid < $invoice->grand_total) {

            $invoice->status = 'Partial';
        } else {

            $invoice->status = 'Paid';
        }

        $invoice->save();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
