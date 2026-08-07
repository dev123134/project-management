@extends('adminlte::page')

@section('title', 'Invoice Management')

@section('content_header')

<div class="row align-items-center">

    <div class="col-lg-3 col-md-12 mb-2">
        <h1 class="mb-0">Invoice Management</h1>
    </div>

    <div class="col-lg-9 col-md-12">
        <form method="GET" action="{{ route('invoices.index') }}">

            <div class="row">

                <div class="col-lg-4 col-md-6 mb-2">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search Invoice / Project"
                        value="{{ request('search') }}">
                </div>

                <div class="col-lg-3 col-md-6 mb-2">
                    <select name="status" class="form-control">

                        <option value="">All Status</option>

                        <option value="Draft" {{ request('status')=='Draft' ? 'selected' : '' }}>Draft</option>

                        <option value="Sent" {{ request('status')=='Sent' ? 'selected' : '' }}>Sent</option>

                        <option value="Partial" {{ request('status')=='Partial' ? 'selected' : '' }}>Partial</option>

                        <option value="Paid" {{ request('status')=='Paid' ? 'selected' : '' }}>Paid</option>

                        <option value="Overdue" {{ request('status')=='Overdue' ? 'selected' : '' }}>Overdue</option>

                    </select>
                </div>

                <div class="col-lg-3 col-md-6 mb-2">

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>

                </div>

                <div class="col-lg-2 col-md-6 mb-2">

                    <a href="{{ route('invoices.index') }}"
                        class="btn btn-secondary w-100">
                        Reset
                    </a>

                </div>

            </div>

        </form>
    </div>

</div>

@stop

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">

        <a href="{{ route('invoices.create') }}"
            class="btn btn-primary mb-2">

            <i class="fas fa-plus"></i> Create Invoice

        </a>



    </div>
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-striped">
                <thead>

                    <tr>

                        <th>#</th>

                        <th>Invoice No</th>

                        <th>Project</th>

                        <th>Invoice Date</th>

                        <th>Due Date</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($invoices as $invoice)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $invoice->invoice_number }}</td>

                        <td>{{ $invoice->project->title ?? '-' }}</td>

                        <td>{{ $invoice->invoice_date }}</td>

                        <td>{{ $invoice->due_date }}</td>

                        <td>₹ {{ number_format($invoice->grand_total,2) }}</td>

                        <td>

                            @if($invoice->status=='Paid')

                            <span class="badge bg-success">

                                Paid

                            </span>

                            @elseif($invoice->status=='Draft')

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                            @elseif($invoice->status=='Sent')

                            <span class="badge bg-primary">

                                Sent

                            </span>

                            @elseif($invoice->status=='Partial')

                            <span class="badge bg-warning">

                                Partial

                            </span>

                            @else

                            <span class="badge bg-danger">

                                Overdue

                            </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('invoices.show',$invoice->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>
                            <a href="{{ route('invoices.pdf', $invoice->id) }}"
                                class="btn btn-danger btn-sm"
                                title="Download PDF">

                                <i class="fas fa-file-pdf"></i>

                            </a>
                            <a href="{{ route('invoices.edit',$invoice->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this invoice?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center">

                            No Invoice Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">

                <div class="mb-2">
                    Showing
                    {{ $invoices->firstItem() ?? 0 }}
                    -
                    {{ $invoices->lastItem() ?? 0 }}
                    of
                    {{ $invoices->total() }}
                    Entries
                </div>

                <div>
                    {{ $invoices->links() }}
                </div>

            </div>
            </table>

        </div>
    </div>

</div>

@stop