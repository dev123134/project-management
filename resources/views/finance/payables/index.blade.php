@extends('adminlte::page')

@section('title', 'Payable Management')

@section('content_header')

<div class="d-flex justify-content-between align-items-center flex-wrap">

    <h1 class="mb-0">

        Payable Management

    </h1>

    <form method="GET"
          action="{{ route('payables.index') }}"
          class="d-flex align-items-center flex-wrap">

        <input type="text"
               name="search"
               class="form-control me-2"
               placeholder="Search Payable No / Vendor"
               value="{{ request('search') }}"
               style="width:260px;">

        <button class="btn btn-primary me-2">

            <i class="fas fa-search"></i>

            Search

        </button>

        <a href="{{ route('payables.index') }}"
           class="btn btn-secondary">

            Reset

        </a>

    </form>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('payables.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Add Payable

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>

                        <th width="60">#</th>

                        <th>Payable No</th>

                        <th>Vendor Name</th>

                        <th>Payable Type</th>

                        <th>Amount</th>

                        <th>Payment Date</th>

                        <th>Due Date</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payables as $payable)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $payable->payable_number }}

                        </td>

                        <td>

                            {{ $payable->vendor_name }}

                        </td>

                        <td>

                            {{ $payable->payable_type }}

                        </td>

                        <td>

                            ₹ {{ number_format($payable->amount,2) }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($payable->payment_date)->format('d-m-Y') }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($payable->due_date)->format('d-m-Y') }}

                        </td>

                        <td>
                            @if($payable->status == 'Paid')

    <span class="badge bg-success">

        Paid

    </span>

@elseif($payable->status == 'Pending')

    <span class="badge bg-warning">

        Pending

    </span>

@else

    <span class="badge bg-danger">

        Overdue

    </span>

@endif

</td>

<td>

    <a href="{{ route('payables.show',$payable->id) }}"
       class="btn btn-info btn-sm">

        <i class="fas fa-eye"></i>

    </a>

    <a href="{{ route('payables.edit',$payable->id) }}"
       class="btn btn-warning btn-sm">

        <i class="fas fa-edit"></i>

    </a>

    <form action="{{ route('payables.destroy',$payable->id) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('Are you sure you want to delete this payable?')">

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

    <td colspan="9" class="text-center">

        No Payable Found

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-3">

    {{ $payables->withQueryString()->links() }}

</div>

</div>

</div>

@stop