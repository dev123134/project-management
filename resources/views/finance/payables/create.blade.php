@extends('adminlte::page')

@section('title', 'Add Payable')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Add Payable</h1>

    <a href="{{ route('payables.index') }}" class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h5 class="mb-0 text-white">

            Add New Payable

        </h5>

    </div>

    <form action="{{ route('payables.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <!-- Payable Number -->

                <div class="col-md-6 mb-3">

                    <label>

                        Payable Number

                    </label>

                    <input type="text"
                           name="payable_number"
                           class="form-control"
                           value="{{ $payableNumber }}"
                           readonly>

                </div>

                <!-- Payable Type -->

                <div class="col-md-6 mb-3">

                    <label>

                        Payable Type

                    </label>

                    <select name="payable_type"
                            class="form-control"
                            required>

                        <option value="">

                            Select Type

                        </option>

                        <option>Office Rent</option>

                        <option>Employee Salary</option>

                        <option>Freelancer Payment</option>

                        <option>Vendor Payment</option>

                        <option>Internet Bill</option>

                        <option>Electricity Bill</option>

                        <option>Hosting Renewal</option>

                        <option>Domain Renewal</option>

                        <option>Software Subscription</option>

                        <option>Other</option>

                    </select>

                </div>

                <!-- Vendor Name -->

                <div class="col-md-6 mb-3">

                    <label>

                        Vendor Name

                    </label>

                    <input type="text"
                           name="vendor_name"
                           class="form-control"
                           placeholder="Enter Vendor Name"
                           required>

                </div>

                <!-- Amount -->

                <div class="col-md-6 mb-3">

                    <label>

                        Amount

                    </label>

                    <input type="number"
                           name="amount"
                           class="form-control"
                           step="0.01"
                           placeholder="Enter Amount"
                           required>

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

                <!-- Due Date -->

                <div class="col-md-6 mb-3">

                    <label>

                        Due Date

                    </label>

                    <input type="date"
                           name="due_date"
                           class="form-control"
                           required>

                </div>

                <!-- Status -->

                <div class="col-md-6 mb-3">

                    <label>

                        Status

                    </label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="Pending">

                            Pending

                        </option>

                        <option value="Paid">

                            Paid

                        </option>

                        <option value="Overdue">

                            Overdue

                        </option>

                    </select>

                </div>

                <!-- Notes -->

                <div class="col-md-6 mb-3">

                    <label>

                        Notes

                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="form-control"
                        placeholder="Enter Notes"></textarea>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Save Payable

            </button>

            <a href="{{ route('payables.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@stop