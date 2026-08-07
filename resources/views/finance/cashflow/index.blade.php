@extends('adminlte::page')

@section('title', 'Cash Flow Statement')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        Cash Flow Statement

    </h1>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-6 mb-3">
        <a href="/invoices">
            <div class="small-box bg-info">

                <div class="inner">

                    <h3>

                        ₹ {{ number_format($totalInvoice,2) }}

                    </h3>

                    <p>

                        Total Invoice Amount

                    </p>

                </div>

                <div class="icon">

                    <i class="fas fa-file-invoice"></i>

                </div>

            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
<a href="/payments">
        <div class="small-box bg-success">

            <div class="inner">

                <h3>

                    ₹ {{ number_format($totalReceived,2) }}

                </h3>

                <p>

                    Total Payment Received

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-money-check-alt"></i>

            </div>

        </div>
</a>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
<a href="/payables">
        <div class="small-box bg-warning">

            <div class="inner">

                <h3>

                    ₹ {{ number_format($totalPayables,2) }}

                </h3>

                <p>

                    Total Expenses

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-wallet"></i>

            </div>

        </div>
</a>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>

                    ₹ {{ number_format($netCashFlow,2) }}

                </h3>

                <p>

                    Net Cash Flow

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-chart-line"></i>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header bg-primary">

        <h5 class="mb-0 text-white">

            Cash Flow Summary

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th width="70%">

                        Description

                    </th>

                    <th>

                        Amount

                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        Total Invoice Amount

                    </td>

                    <td>

                        ₹ {{ number_format($totalInvoice,2) }}

                    </td>

                </tr>

                <tr>

                    <td>

                        Total Payment Received

                    </td>

                    <td>

                        ₹ {{ number_format($totalReceived,2) }}

                    </td>

                </tr>

                <tr>

                    <td>

                        Total Expenses

                    </td>

                    <td>

                        ₹ {{ number_format($totalPayables,2) }}

                    </td>

                </tr>
                <tr class="table-success">

                    <th>

                        Net Cash Flow

                    </th>

                    <th>

                        ₹ {{ number_format($netCashFlow,2) }}

                    </th>

                </tr>

            </tbody>

        </table>

        <hr>

        @if($netCashFlow > 0)

        <div class="alert alert-success mb-0">

            <h5>

                <i class="fas fa-check-circle"></i>

                Financial Status : Profit

            </h5>

            <p class="mb-0">

                Your company currently has a <strong>Positive Cash Flow</strong>.

            </p>

        </div>

        @elseif($netCashFlow == 0)

        <div class="alert alert-warning mb-0">

            <h5>

                <i class="fas fa-exclamation-circle"></i>

                Financial Status : Balanced

            </h5>

            <p class="mb-0">

                Income and Expenses are equal.

            </p>

        </div>

        @else

        <div class="alert alert-danger mb-0">

            <h5>

                <i class="fas fa-times-circle"></i>

                Financial Status : Loss

            </h5>

            <p class="mb-0">

                Expenses are higher than received payments.

            </p>

        </div>

        @endif

    </div>

</div>

@stop