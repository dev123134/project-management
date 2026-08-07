<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('project');

        // Search by Invoice Number
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('invoice_number', 'LIKE', "%{$search}%")

                    ->orWhereHas('project', function ($project) use ($search) {

                        $project->where('title', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $invoices = $query
            ->oldest()
            ->paginate(10)
            ->withQueryString();

        return view('finance.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();

        // Generate PO Number
        $lastInvoice = Invoice::latest()->first();

        if ($lastInvoice && $lastInvoice->po_number) {

            $lastNumber = (int) substr($lastInvoice->po_number, 3);

            $poNumber = 'PO-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {

            $poNumber = 'PO-0001';
        }

        return view(
            'finance.invoices.create',
            compact('projects', 'poNumber')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'      => 'required|exists:projects,id',
            'invoice_date'    => 'required|date',
            'due_date'        => 'required|date|after_or_equal:invoice_date',
            'po_number' => 'nullable|string|max:100',
            'po_date'   => 'nullable|date',
            'subtotal'        => 'required|numeric|min:0',
            'description'        => 'required|array|min:1',
            'description.*'      => 'required|string',

            'hsn_code'           => 'nullable|array',

            'quantity'           => 'required|array',
            'quantity.*'         => 'required|numeric|min:1',

            'unit'               => 'nullable|array',

            'unit_price'         => 'required|array',
            'unit_price.*'       => 'required|numeric|min:0',

            'tax_percentage'     => 'required|array',
            'tax_percentage.*'   => 'required|numeric|min:0',

            'item_total'         => 'required|array',
            'discount'        => 'nullable|numeric|min:0',
            'grand_total'     => 'required|numeric|min:0',
            'notes'           => 'nullable|string',
        ]);

        // Generate Invoice Number
        $lastInvoice = Invoice::latest()->first();

        if ($lastInvoice) {
            $lastNumber = (int) substr($lastInvoice->invoice_number, 4);
            $invoiceNumber = 'INV-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $invoiceNumber = 'INV-0001';
        }

        $subtotal = 0;

        $totalTax = 0;

        $discount = (float) ($request->discount ?? 0);

        foreach ($request->description as $key => $description) {

            $qty = (float) $request->quantity[$key];

            $rate = (float) $request->unit_price[$key];

            $tax = (float) $request->tax_percentage[$key];

            $amount = $qty * $rate;

            $taxAmount = ($amount * $tax) / 100;

            $subtotal += $amount;

            $totalTax += $taxAmount;
        }

        $grandTotal = $subtotal + $totalTax - $discount;

        if ($grandTotal < 0) {

            $grandTotal = 0;
        }

        $invoice = Invoice::create([
            'project_id'      => $request->project_id,
            'invoice_number'  => $invoiceNumber,
            'invoice_date'    => $request->invoice_date,
            'due_date'        => $request->due_date,
            'po_number' => $request->po_number,
            'po_date'   => $request->po_date,
            'subtotal'        => $subtotal,
            'tax_percentage'  => 0,
            'tax_amount'      => $totalTax,
            'discount'        => $discount,
            'grand_total'     => $grandTotal,
            'status'          => 'Draft',
            'notes'           => $request->notes,
            'created_by'      => Auth::id(),
        ]);
        foreach ($request->description as $key => $description) {

            $qty = (float) $request->quantity[$key];

            $rate = (float) $request->unit_price[$key];

            $tax = (float) $request->tax_percentage[$key];

            $amount = $qty * $rate;

            $taxAmount = ($amount * $tax) / 100;

            InvoiceItem::create([

                'invoice_id'      => $invoice->id,

                'description'     => $description,

                'hsn_code'        => $request->hsn_code[$key] ?? null,

                'quantity'        => $qty,

                'unit'            => $request->unit[$key] ?? null,

                'unit_price'      => $rate,

                'tax_percentage'  => $tax,

                'tax_amount'      => $taxAmount,

                'total'           => $amount + $taxAmount,

            ]);
        }
        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('project', 'creator', 'items');

        return view('finance.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $projects = Project::orderBy('title')->get();

        $invoice->load('items');

        return view(
            'finance.invoices.edit',
            compact(
                'invoice',
                'projects'
            )
        );
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'project_id'      => 'required|exists:projects,id',
            'invoice_date'    => 'required|date',
            'due_date'        => 'required|date|after_or_equal:invoice_date',
            'subtotal'        => 'required|numeric|min:0',
            'tax_percentage_item'   => 'required|array',
            'tax_percentage_item.*' => 'required|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0',
            'grand_total'     => 'required|numeric|min:0',
            'status'          => 'required|in:Draft,Sent,Partial,Paid,Overdue',
            'notes'           => 'nullable|string',
        ]);
        $subtotal = 0;

        $totalTax = 0;

        $discount = (float) ($request->discount ?? 0);

        foreach ($request->description as $key => $description) {

            $qty  = (float) ($request->quantity[$key] ?? 0);

            $rate = (float) ($request->unit_price[$key] ?? 0);

            $tax  = (float) ($request->tax_percentage_item[$key] ?? 0);

            $amount = $qty * $rate;

            $taxAmount = ($amount * $tax) / 100;

            $subtotal += $amount;

            $totalTax += $taxAmount;
        }

        $grandTotal = $subtotal + $totalTax - $discount;

        if ($grandTotal < 0) {

            $grandTotal = 0;
        }

        $invoice->update([
            'project_id'      => $request->project_id,
            'invoice_date'    => $request->invoice_date,
            'due_date'        => $request->due_date,
            'subtotal'        => $subtotal,
            'tax_percentage'  => 0,
            'tax_amount'      => $totalTax,
            'discount'        => $discount,
            'grand_total'     => $grandTotal,
            'status'          => $request->status,
            'notes'           => $request->notes,
        ]);
        // Delete Old Invoice Items
        // Existing Item IDs
        $existingIds = $invoice->items()->pluck('id')->toArray();

        $submittedIds = [];

        if ($request->has('description')) {

            foreach ($request->description as $key => $description) {

                if (trim($description) == '') {
                    continue;
                }

                $qty  = $request->quantity[$key] ?? 1;
                $rate = $request->unit_price[$key] ?? 0;
                $tax  = $request->tax_percentage_item[$key] ?? 0;

                $amount = $qty * $rate;
                $taxAmount = ($amount * $tax) / 100;
                $total = $amount + $taxAmount;

                if (!empty($request->item_id[$key])) {

                    // Update Existing Item
                    $item = InvoiceItem::find($request->item_id[$key]);

                    if ($item) {

                        $item->update([

                            'description'    => $description,
                            'hsn_code'       => $request->hsn_code[$key] ?? null,
                            'quantity'       => $qty,
                            'unit'           => $request->unit[$key] ?? null,
                            'unit_price'     => $rate,
                            'tax_percentage' => $tax,
                            'tax_amount'     => $taxAmount,
                            'total'          => $total,

                        ]);

                        $submittedIds[] = $item->id;
                    }
                } else {

                    // Create New Item
                    $item = InvoiceItem::create([

                        'invoice_id'      => $invoice->id,
                        'description'     => $description,
                        'hsn_code'        => $request->hsn_code[$key] ?? null,
                        'quantity'        => $qty,
                        'unit'            => $request->unit[$key] ?? null,
                        'unit_price'      => $rate,
                        'tax_percentage'  => $tax,
                        'total'           => $total,

                    ]);

                    $submittedIds[] = $item->id;
                }
            }
        }

        // Delete Removed Items
        InvoiceItem::where('invoice_id', $invoice->id)
            ->whereNotIn('id', $submittedIds)
            ->delete();
        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(

            'project',

            'creator',

            'items'

        );

        $logo = public_path('images/logo.jpeg');

        $pdf = Pdf::loadView(
            'finance.invoices.pdf',
            compact('invoice', 'logo')
        );
        return $pdf->download($invoice->invoice_number . '.pdf');
    }
}
