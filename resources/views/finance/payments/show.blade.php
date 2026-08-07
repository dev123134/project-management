@extends('adminlte::page')

@section('title', 'Payment Details')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Payment Details</h1>

    <a href="{{ route('payments.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i> Back

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h5 class="mb-0 text-white">

            Payment Information

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">Invoice Number</th>
                <td>{{ $payment->invoice->invoice_number }}</td>
            </tr>

            <tr>
                <th>Project</th>
                <td>{{ $payment->invoice->project->title ?? '-' }}</td>
            </tr>

            <tr>
                <th>Payment Date</th>
                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
            </tr>

            <tr>
                <th>Payment Method</th>
                <td>{{ $payment->payment_method }}</td>
            </tr>

            <tr>
                <th>Transaction ID</th>
                <td>{{ $payment->transaction_id ?: '-' }}</td>
            </tr>

            <tr>
                <th>Amount Received</th>
                <td>
                    ₹ {{ number_format($payment->amount,2) }}
                </td>
            </tr>

            <tr>
                <th>Received By</th>
                <td>{{ $payment->receiver->name ?? '-' }}</td>
            </tr>

            <tr>
                <th>Notes</th>
                <td>{{ $payment->notes ?: '-' }}</td>
            </tr>

            <tr>
                <th>Invoice Status</th>
                <td>

                    @if($payment->invoice->status=='Paid')

                        <span class="badge bg-success">

                            Paid

                        </span>

                    @elseif($payment->invoice->status=='Partial')

                        <span class="badge bg-warning">

                            Partial

                        </span>

                    @else

                        <span class="badge bg-secondary">

                            {{ $payment->invoice->status }}

                        </span>

                    @endif

                </td>
            </tr>

        </table>

    </div>

</div>

@stop