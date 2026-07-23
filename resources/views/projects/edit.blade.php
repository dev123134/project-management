@extends('adminlte::page')

@section('title', 'Edit Project')

@section('content_header')
<h1>Edit Project</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Edit Project Information

        </h3>

    </div>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Project Title</label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $project->title) }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Client Name</label>

                        <select
                            name="client_id"
                            class="form-control"
                            required>

                            <option value="">Select Client</option>

                            @foreach($clients as $client)

                            <option
                                value="{{ $client->id }}"
                                {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>

                                {{ $client->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Service Location</label>

                        <input
                            type="text"
                            name="service_location"
                            class="form-control"
                            value="{{ old('service_location', $project->service_location) }}">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Nature of Work</label>

                        <input
                            type="text"
                            name="nature_of_work"
                            class="form-control"
                            value="{{ old('nature_of_work', $project->nature_of_work) }}">

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Work Details</label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control">{{ old('description', $project->description) }}</textarea>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Project Start Date</label>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control"
                            value="{{ old('start_date', $project->start_date) }}">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Deadline</label>

                        <input
                            type="date"
                            name="deadline"
                            class="form-control"
                            value="{{ old('deadline', $project->deadline) }}"
                            required>

                    </div>

                </div>

            </div>
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Project Value (₹)</label>

                        <input
                            type="number"
                            name="budget"
                            class="form-control"
                            value="{{ old('budget', $project->budget) }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Billing Address</label>

                        <textarea
                            name="billing_address"
                            rows="3"
                            class="form-control">{{ old('billing_address', $project->billing_address) }}</textarea>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Invoice Status</label>

                        <select
                            name="invoice_status"
                            class="form-control">

                            <option value="Pending"
                                {{ old('invoice_status', $project->invoice_status) == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Generated"
                                {{ old('invoice_status', $project->invoice_status) == 'Generated' ? 'selected' : '' }}>
                                Generated
                            </option>

                            <option value="Paid"
                                {{ old('invoice_status', $project->invoice_status) == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Payment Status</label>

                        <select
                            name="payment_status"
                            class="form-control">

                            <option value="Pending"
                                {{ old('payment_status', $project->payment_status) == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Partial"
                                {{ old('payment_status', $project->payment_status) == 'Partial' ? 'selected' : '' }}>
                                Partial
                            </option>

                            <option value="Paid"
                                {{ old('payment_status', $project->payment_status) == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>Project Status</label>

                        <select
                            name="status"
                            class="form-control">

                            <option value="Pending"
                                {{ old('status', $project->status) == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="In Progress"
                                {{ old('status', $project->status) == 'In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="Completed"
                                {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                Update Project

            </button>


            <a href="{{ route('admin.project.monitoring.index') }}"
                class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <button
                type="reset"
                class="btn btn-warning float-right">

                <i class="fas fa-redo"></i>

                Reset

            </button>

        </div>

    </form>

</div>

@stop