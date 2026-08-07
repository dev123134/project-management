@extends('adminlte::page')

@section('title', 'Payment Management')

@section('content_header')

<div class="d-flex justify-content-between align-items-center flex-wrap">

    <h1 class="mb-0">
        Payment Management
    </h1>

    <form method="GET"
          action="{{ route('payments.index') }}"
          class="d-flex align-items-center flex-wrap">

        <input type="text"
               name="search"
               class="form-control me-2"
               placeholder="Search Invoice No / Transaction ID"
               value="{{ request('search') }}"
               style="width:260px;">

        <button class="btn btn-primary me-2">
            <i class="fas fa-search"></i> Search
        </button>

        <a href="{{ route('payments.index') }}"
           class="btn btn-secondary">
            Reset
        </a>

    </form>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('payments.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Receive Payment

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>

                        <th width="60">#</th>

                        <th>Invoice No</th>

                        <th>Payment Date</th>

                        <th>Method</th>

                        <th>Transaction ID</th>

                        <th>Recived Amount</th>

                        <th>Received By</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $payment->invoice->invoice_number ?? '-' }}</td>

                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>

                        <td>{{ $payment->payment_method }}</td>

                        <td>{{ $payment->transaction_id ?? '-' }}</td>

                        <td>₹ {{ number_format($payment->amount,2) }}</td>

                        <td>{{ $payment->receiver->name ?? '-' }}</td>

                        <td>

                            <a href="{{ route('payments.show',$payment->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('payments.edit',$payment->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('payments.destroy',$payment->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this payment?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            No Payment Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $payments->withQueryString()->links() }}

        </div>

    </div>

</div>

@stop