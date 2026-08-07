@extends('adminlte::page')

@section('title', 'Edit Payable')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Edit Payable</h1>

    <a href="{{ route('payables.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-warning">

        <h5 class="mb-0 text-dark">

            Edit Payable

        </h5>

    </div>

    <form action="{{ route('payables.update',$payable->id) }}"
          method="POST">

        @csrf

        @method('PUT')

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
                           value="{{ old('payable_number',$payable->payable_number) }}"
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

                        <option value="">Select Type</option>

                        <option value="Office Rent"
                            {{ $payable->payable_type=='Office Rent' ? 'selected' : '' }}>
                            Office Rent
                        </option>

                        <option value="Employee Salary"
                            {{ $payable->payable_type=='Employee Salary' ? 'selected' : '' }}>
                            Employee Salary
                        </option>

                        <option value="Freelancer Payment"
                            {{ $payable->payable_type=='Freelancer Payment' ? 'selected' : '' }}>
                            Freelancer Payment
                        </option>

                        <option value="Vendor Payment"
                            {{ $payable->payable_type=='Vendor Payment' ? 'selected' : '' }}>
                            Vendor Payment
                        </option>

                        <option value="Internet Bill"
                            {{ $payable->payable_type=='Internet Bill' ? 'selected' : '' }}>
                            Internet Bill
                        </option>

                        <option value="Electricity Bill"
                            {{ $payable->payable_type=='Electricity Bill' ? 'selected' : '' }}>
                            Electricity Bill
                        </option>

                        <option value="Hosting Renewal"
                            {{ $payable->payable_type=='Hosting Renewal' ? 'selected' : '' }}>
                            Hosting Renewal
                        </option>

                        <option value="Domain Renewal"
                            {{ $payable->payable_type=='Domain Renewal' ? 'selected' : '' }}>
                            Domain Renewal
                        </option>

                        <option value="Software Subscription"
                            {{ $payable->payable_type=='Software Subscription' ? 'selected' : '' }}>
                            Software Subscription
                        </option>

                        <option value="Other"
                            {{ $payable->payable_type=='Other' ? 'selected' : '' }}>
                            Other
                        </option>

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
                           value="{{ old('vendor_name',$payable->vendor_name) }}"
                           required>

                </div>

                <!-- Amount -->

                <div class="col-md-6 mb-3">

                    <label>

                        Amount

                    </label>

                    <input type="number"
                           name="amount"
                           step="0.01"
                           class="form-control"
                           value="{{ old('amount',$payable->amount) }}"
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
                           value="{{ old('payment_date',$payable->payment_date) }}"
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
                           value="{{ old('due_date',$payable->due_date) }}"
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

                        <option value="Pending"
                            {{ $payable->status=='Pending' ? 'selected' : '' }}>

                            Pending

                        </option>

                        <option value="Paid"
                            {{ $payable->status=='Paid' ? 'selected' : '' }}>

                            Paid

                        </option>

                        <option value="Overdue"
                            {{ $payable->status=='Overdue' ? 'selected' : '' }}>

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
                        class="form-control">{{ old('notes',$payable->notes) }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>

                Update Payable

            </button>

            <a href="{{ route('payables.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@stop