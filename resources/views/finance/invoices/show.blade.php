@extends('adminlte::page')

@section('title', 'View Invoice')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Invoice Details</h1>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                Invoice : {{ $invoice->invoice_number }}
            </h4>

            <!-- <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> PDF
            </a> -->
        </div>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <strong>Invoice Number</strong><br>
                {{ $invoice->invoice_number }}
            </div>

            <div class="col-md-6 mb-3">
                <strong>Status</strong><br>
                @if($invoice->status == 'Paid')
                <span class="badge badge-success">{{ $invoice->status }}</span>
                @elseif($invoice->status == 'Draft')
                <span class="badge badge-secondary">{{ $invoice->status }}</span>
                @elseif($invoice->status == 'Sent')
                <span class="badge badge-primary">{{ $invoice->status }}</span>
                @elseif($invoice->status == 'Partial')
                <span class="badge badge-warning">{{ $invoice->status }}</span>
                @else
                <span class="badge badge-danger">{{ $invoice->status }}</span>
                @endif
            </div>

            <div class="col-md-6 mb-3">
                <strong>Project</strong><br>
                {{ $invoice->project->title ?? '-' }}
            </div>

            <div class="col-md-6 mb-3">
                <strong>Created By</strong><br>
                {{ $invoice->creator->name ?? '-' }}
            </div>

            <div class="col-md-6 mb-3">
                <strong>Invoice Date</strong><br>
                {{ $invoice->invoice_date }}
            </div>

            <div class="col-md-6 mb-3">
                <strong>Due Date</strong><br>
                {{ $invoice->due_date }}
            </div>
            <div class="col-md-6 mb-3">

                <strong>PO Number</strong><br>

                {{ $invoice->po_number ?? '-' }}

            </div>

            <div class="col-md-6 mb-3">

                <strong>PO Date</strong><br>

                @if($invoice->po_date)

                {{ \Carbon\Carbon::parse($invoice->po_date)->format('d-m-Y') }}

                @else

                -

                @endif

            </div>
        </div>

        <hr>

        <h5 class="mb-3">Invoice Items</h5>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Description</th>
                        <th>HSN/SAC</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Rate</th>
                        <th>Tax %</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoice->items as $item)
                    <tr>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->hsn_code ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit ?? '-' }}</td>
                        <td>₹ {{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($item->tax_percentage, 2) }}%</td>
                        <td>₹ {{ number_format($item->total, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Invoice Items Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>Notes</strong><br>
                @if($invoice->notes)
                {{ $invoice->notes }}
                @else
                <span class="text-muted">No Notes Available</span>
                @endif
            </div>

            <div class="col-md-6 mb-3">
                <table class="table table-bordered">
                    <tr>
                        <th>Subtotal</th>
                        <td>₹ {{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Tax Amount</th>
                        <td>₹ {{ number_format($invoice->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>₹ {{ number_format($invoice->discount, 2) }}</td>
                    </tr>
                    <tr class="table-success">
                        <th>Grand Total</th>
                        <td><strong>₹ {{ number_format($invoice->grand_total, 2) }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</div>

@stop