@extends('adminlte::page')

@section('title', 'Receive Payment')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Receive Payment</h1>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h5 class="mb-0 text-white">
            Receive Payment
        </h5>

    </div>

    <form action="{{ route('payments.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <!-- Invoice -->

                <div class="col-md-6 mb-3">

                    <label>
                        Invoice
                        <span class="text-danger">*</span>
                    </label>

                    <select name="invoice_id"
                            id="invoice_id"
                            class="form-control"
                            required>

                        <option value="">
                            Select Invoice
                        </option>

                        @foreach($invoices as $invoice)

                            <option
                                value="{{ $invoice->id }}"
                                data-total="{{ $invoice->grand_total }}">

                                {{ $invoice->invoice_number }}

                                (₹ {{ number_format($invoice->grand_total,2) }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Payment Date -->

                <div class="col-md-6 mb-3">

                    <label>
                        Payment Date
                    </label>

                    <input type="date"
                           name="payment_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>

                </div>

                <!-- Invoice Total -->

                <div class="col-md-4 mb-3">

                    <label>
                        Invoice Total
                    </label>

                    <input type="text"
                           id="invoice_total"
                           class="form-control"
                           readonly>

                </div>

                <!-- Already Paid -->

                <div class="col-md-4 mb-3">

                    <label>
                        Already Paid
                    </label>

                    <input type="text"
                           id="already_paid"
                           class="form-control"
                           value="0.00"
                           readonly>

                </div>

                <!-- Remaining -->

                <div class="col-md-4 mb-3">

                    <label>
                        Remaining Balance
                    </label>

                    <input type="text"
                           id="remaining_balance"
                           class="form-control"
                           readonly>

                </div>

                <!-- Payment Method -->

                <div class="col-md-6 mb-3">

                    <label>
                        Payment Method
                    </label>

                    <select name="payment_method"
                            class="form-control"
                            required>

                        <option value="">
                            Select Payment Method
                        </option>

                        <option>Cash</option>

                        <option>Bank Transfer</option>

                        <option>UPI</option>

                        <option>Cheque</option>

                        <option>Credit Card</option>

                        <option>Debit Card</option>

                        <option>Online Payment</option>

                    </select>

                </div>

                <!-- Transaction -->

                <div class="col-md-6 mb-3">

                    <label>
                        Transaction ID
                    </label>

                    <input type="text"
                           name="transaction_id"
                           class="form-control"
                           placeholder="Optional">

                </div>

                <!-- Amount -->

                <div class="col-md-6 mb-3">

                    <label>
                        Amount Received
                    </label>

                    <input type="number"
                           name="amount"
                           step="0.01"
                           class="form-control"
                           required>

                </div>

                <!-- Notes -->

                <div class="col-md-6 mb-3">

                    <label>
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="form-control"></textarea>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Payment

            </button>

            <a href="{{ route('payments.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection

@section('js')

<script>

document.getElementById('invoice_id').addEventListener('change', function () {

    let invoiceId = this.value;

    if (invoiceId == '') {

        document.getElementById('invoice_total').value = '';

        document.getElementById('already_paid').value = '';

        document.getElementById('remaining_balance').value = '';

        return;
    }

    fetch('/payments/invoice/' + invoiceId)

        .then(response => response.json())

        .then(data => {

            document.getElementById('invoice_total').value =
                parseFloat(data.invoice_total).toFixed(2);

            document.getElementById('already_paid').value =
                parseFloat(data.already_paid).toFixed(2);

            document.getElementById('remaining_balance').value =
                parseFloat(data.remaining_balance).toFixed(2);

        })

        .catch(error => {

            console.log(error);

        });

});

</script>

@stop