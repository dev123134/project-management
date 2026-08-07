@extends('adminlte::page')

@section('title', 'Edit Payment')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Edit Payment</h1>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-warning">

        <h5 class="mb-0 text-dark">

            Edit Payment

        </h5>

    </div>

    <form action="{{ route('payments.update',$payment->id) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="card-body">

            <div class="row">

                <!-- Invoice -->

                <div class="col-md-6 mb-3">

                    <label>

                        Invoice

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="invoice_id"
                        id="invoice_id"
                        class="form-control"
                        required>

                        @foreach($invoices as $invoice)

                        <option
                            value="{{ $invoice->id }}"
                            data-total="{{ $invoice->grand_total }}"
                            {{ $payment->invoice_id == $invoice->id ? 'selected' : '' }}>

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

                    <input
                        type="date"
                        name="payment_date"
                        class="form-control"
                        value="{{ old('payment_date',$payment->payment_date) }}"
                        required>

                </div>

                <!-- Invoice Total -->

                <div class="col-md-4 mb-3">

                    <label>

                        Invoice Total

                    </label>

                    <input
                        type="text"
                        id="invoice_total"
                        class="form-control"
                        readonly>

                </div>

                <!-- Already Paid -->

                <div class="col-md-4 mb-3">

                    <label>

                        Already Paid

                    </label>

                    <input
                        type="text"
                        id="already_paid"
                        class="form-control"
                        readonly>

                </div>

                <!-- Remaining -->

                <div class="col-md-4 mb-3">

                    <label>

                        Remaining Balance

                    </label>

                    <input
                        type="text"
                        id="remaining_balance"
                        class="form-control"
                        readonly>

                </div>

                <!-- Payment Method -->

                <div class="col-md-6 mb-3">

                    <label>

                        Payment Method

                    </label>

                    <select
                        name="payment_method"
                        class="form-control"
                        required>

                        <option value="">Select Payment Method</option>

                        <option value="Cash"
                            {{ $payment->payment_method=='Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="Bank Transfer"
                            {{ $payment->payment_method=='Bank Transfer' ? 'selected' : '' }}>
                            Bank Transfer
                        </option>

                        <option value="UPI"
                            {{ $payment->payment_method=='UPI' ? 'selected' : '' }}>
                            UPI
                        </option>

                        <option value="Cheque"
                            {{ $payment->payment_method=='Cheque' ? 'selected' : '' }}>
                            Cheque
                        </option>

                        <option value="Credit Card"
                            {{ $payment->payment_method=='Credit Card' ? 'selected' : '' }}>
                            Credit Card
                        </option>

                        <option value="Debit Card"
                            {{ $payment->payment_method=='Debit Card' ? 'selected' : '' }}>
                            Debit Card
                        </option>

                        <option value="Online Payment"
                            {{ $payment->payment_method=='Online Payment' ? 'selected' : '' }}>
                            Online Payment
                        </option>

                    </select>

                </div>

                <!-- Transaction -->

                <div class="col-md-6 mb-3">

                    <label>

                        Transaction ID

                    </label>

                    <input
                        type="text"
                        name="transaction_id"
                        class="form-control"
                        value="{{ old('transaction_id',$payment->transaction_id) }}">

                </div>

                <!-- Amount -->

                <div class="col-md-6 mb-3">

                    <label>

                        Amount Received

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="amount"
                        class="form-control"
                        value="{{ old('amount',$payment->amount) }}"
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
                        class="form-control">{{ old('notes',$payment->notes) }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Update Payment

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
    function loadInvoiceDetails(invoiceId) {
        if (invoiceId == '') {
            document.getElementById('invoice_total').value = '';
            document.getElementById('already_paid').value = '';
            document.getElementById('remaining_balance').value = '';
            return;
        }

        fetch('/payments/invoice/' + invoiceId + '?payment_id={{ $payment->id }}')

            .then(response => response.json())

            .then(data => {

                document.getElementById('invoice_total').value =
                    parseFloat(data.invoice_total).toFixed(2);

                document.getElementById('already_paid').value =
                    parseFloat(data.already_paid).toFixed(2);

                document.getElementById('remaining_balance').value =
                    parseFloat(data.remaining_balance).toFixed(2);

            })

            .catch(error => console.log(error));

    }

    // Page Load
    loadInvoiceDetails(document.getElementById('invoice_id').value);

    // Invoice Change
    document.getElementById('invoice_id').addEventListener('change', function() {

        loadInvoiceDetails(this.value);

    });
</script>

@stop