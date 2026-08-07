@extends('adminlte::page')

@section('title', 'Edit Invoice')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Edit Invoice</h1>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Back
    </a>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">
            Edit Invoice #{{ $invoice->invoice_number }}
        </h5>
    </div>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Project</label>
                    <select name="project_id" class="form-control" required>
                        <option value="">-- Select Project --</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ $invoice->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->title }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Invoice Date</label>
                    <input type="date"
                        name="invoice_date"
                        class="form-control"
                        value="{{ date('Y-m-d', strtotime($invoice->invoice_date)) }}"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Due Date</label>
                    <input type="date"
                        name="due_date"
                        class="form-control"
                        value="{{ date('Y-m-d', strtotime($invoice->due_date)) }}"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>PO Number</label>
                    <input type="text"
                        name="po_number"
                        class="form-control"
                        value="{{ $invoice->po_number }}"
                        readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>PO Date</label>
                    <input type="date"
                        name="po_date"
                        class="form-control"
                        value="{{ $invoice->po_date ? date('Y-m-d', strtotime($invoice->po_date)) : '' }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        @foreach(['Draft', 'Sent', 'Partial', 'Paid', 'Overdue'] as $statusOption)
                        <option value="{{ $statusOption }}"
                            {{ $invoice->status == $statusOption ? 'selected' : '' }}>
                            {{ $statusOption }}
                        </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <hr>

            <h5>Invoice Items</h5>

            <div class="table-responsive">
                <table class="table table-bordered" id="invoiceTable">
                    <thead class="table-light">
                        <tr>
                            <th width="25%">Description</th>
                            <th width="12%">HSN/SAC</th>
                            <th width="8%">Qty</th>
                            <th width="10%">Unit</th>
                            <th width="12%">Rate</th>
                            <th width="10%">Tax %</th>
                            <th width="13%">Amount</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceItems">
                        @foreach($invoice->items as $item)
                        <tr>

                            <td>
                                <input type="hidden"
                                    name="item_id[]"
                                    value="{{ $item->id }}">
                                    
                                <input type="text"
                                    name="description[]"
                                    class="form-control"
                                    value="{{ $item->description }}"
                                    required>
                            </td>
                            <td>
                                <input type="text"
                                    name="hsn_code[]"
                                    class="form-control"
                                    value="{{ $item->hsn_code }}">
                            </td>
                            <td>
                                <input type="number"
                                    name="quantity[]"
                                    class="form-control qty"
                                    value="{{ $item->quantity }}"
                                    min="1">
                            </td>
                            <td>
                                <input type="text"
                                    name="unit[]"
                                    class="form-control"
                                    value="{{ $item->unit }}"
                                    placeholder="PCS">
                            </td>
                            <td>
                                <input type="number"
                                    step="0.01"
                                    name="unit_price[]"
                                    class="form-control rate"
                                    value="{{ $item->unit_price }}">
                            </td>
                            <td>
                                <input type="number"
                                    step="0.01"
                                    name="tax_percentage_item[]"
                                    class="form-control tax"
                                    value="{{ $item->tax_percentage }}">
                            </td>
                            <td>
                                <input type="number"
                                    step="0.01"
                                    name="item_total[]"
                                    class="form-control amount"
                                    value="{{ $item->total }}"
                                    readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeRow">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-primary mt-2" id="addRow">
                <i class="fas fa-plus"></i>
                Add Item
            </button>

            <hr>

            <h5>Invoice Summary</h5>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Subtotal</label>
                    <input type="number"
                        step="0.01"
                        name="subtotal"
                        id="subtotal"
                        class="form-control"
                        value="{{ $invoice->subtotal }}"
                        readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Tax</label>
                    <input type="number"
                        step="0.01"
                        name="tax"
                        id="tax"
                        class="form-control"
                        value="{{ $invoice->tax_amount }}"
                        readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Discount</label>
                    <input type="number"
                        step="0.01"
                        name="discount"
                        id="discount"
                        class="form-control"
                        value="{{ $invoice->discount }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Grand Total</label>
                    <input type="number"
                        step="0.01"
                        name="grand_total"
                        id="grand_total"
                        class="form-control"
                        value="{{ $invoice->grand_total }}"
                        readonly>
                </div>

            </div>

            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes"
                    rows="4"
                    class="form-control"
                    placeholder="Enter Notes">{{ $invoice->notes }}</textarea>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Update Invoice
            </button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection

@section('js')
<script>
    function calculateTotals() {
        let subtotal = 0;
        let totalTax = 0;

        document.querySelectorAll("#invoiceItems tr").forEach(function(row) {

            let qty = parseFloat(row.querySelector(".qty").value) || 0;
            let rate = parseFloat(row.querySelector(".rate").value) || 0;
            let tax = parseFloat(row.querySelector(".tax").value) || 0;

            let amount = qty * rate;
            let taxAmount = (amount * tax) / 100;

            row.querySelector(".amount").value = (amount + taxAmount).toFixed(2);

            subtotal += amount;
            totalTax += taxAmount;
        });

        document.getElementById("subtotal").value = subtotal.toFixed(2);
        document.getElementById("tax").value = totalTax.toFixed(2);

        let discount = parseFloat(document.getElementById("discount").value) || 0;
        let grandTotal = subtotal + totalTax - discount;

        document.getElementById("grand_total").value = grandTotal.toFixed(2);
    }

    document.addEventListener("input", function(e) {
        if (
            e.target.classList.contains("qty") ||
            e.target.classList.contains("rate") ||
            e.target.classList.contains("tax") ||
            e.target.id == "discount"
        ) {
            calculateTotals();
        }
    });

    document.getElementById("addRow").addEventListener("click", function() {

        let row = `
<tr>

<td>
<input type="hidden"
       name="item_id[]"
       value="">
<input type="text" name="description[]" class="form-control" required>
</td>

<td>
<input type="text" name="hsn_code[]" class="form-control">
</td>

<td>
<input type="number" name="quantity[]" class="form-control qty" value="1" min="1">
</td>

<td>
<input type="text" name="unit[]" class="form-control" placeholder="PCS">
</td>

<td>
<input type="number" step="0.01" name="unit_price[]" class="form-control rate" value="0">
</td>

<td>
<input type="number" step="0.01" name="tax_percentage_item[]" class="form-control tax" value="0">
</td>

<td>
<input type="number" step="0.01" name="item_total[]" class="form-control amount" value="0" readonly>
</td>

<td>
<button type="button" class="btn btn-danger removeRow">
<i class="fas fa-trash"></i>
</button>
</td>

</tr>
`;

        document.getElementById("invoiceItems").insertAdjacentHTML("beforeend", row);
    });

    document.addEventListener("click", function(e) {
        if (e.target.closest(".removeRow")) {
            e.preventDefault();

            let rows = document.querySelectorAll("#invoiceItems tr");

            if (rows.length > 1) {
                e.target.closest("tr").remove();
                calculateTotals();
            }
        }
    });

    calculateTotals();
</script>
@stop