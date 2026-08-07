@extends('adminlte::page')

@section('title','Payable Details')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Payable Details</h1>

    <a href="{{ route('payables.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Back

    </a>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h5 class="mb-0 text-white">

            Payable Information

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">

                    Payable Number

                </th>

                <td>

                    {{ $payable->payable_number }}

                </td>

            </tr>

            <tr>

                <th>

                    Vendor Name

                </th>

                <td>

                    {{ $payable->vendor_name }}

                </td>

            </tr>

            <tr>

                <th>

                    Payable Type

                </th>

                <td>

                    {{ $payable->payable_type }}

                </td>

            </tr>

            <tr>

                <th>

                    Amount

                </th>

                <td>

                    ₹ {{ number_format($payable->amount,2) }}

                </td>

            </tr>

            <tr>

                <th>

                    Payment Date

                </th>

                <td>

                    {{ \Carbon\Carbon::parse($payable->payment_date)->format('d-m-Y') }}

                </td>

            </tr>

            <tr>

                <th>

                    Due Date

                </th>

                <td>

                    {{ \Carbon\Carbon::parse($payable->due_date)->format('d-m-Y') }}

                </td>

            </tr>

            <tr>

                <th>

                    Status

                </th>

                <td>

                    @if($payable->status=='Paid')

                        <span class="badge bg-success">

                            Paid

                        </span>

                    @elseif($payable->status=='Pending')

                        <span class="badge bg-warning">

                            Pending

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Overdue

                        </span>

                    @endif

                </td>

            </tr>

            <tr>

                <th>

                    Notes

                </th>

                <td>

                    {{ $payable->notes ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>

                    Created By

                </th>

                <td>

                    {{ $payable->creator->name ?? '-' }}

                </td>

            </tr>

        </table>

    </div>

</div>

@stop