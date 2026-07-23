@extends('adminlte::page')

@section('title', 'Add Subscription Plan')

@section('content')



    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Add Subscription Plan</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.subscriptions.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

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
                    <h3 class="card-title">Subscription Plan Details</h3>
                </div>

                <form action="{{ route('admin.subscriptions.store') }}" method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label>Plan Name</label>
                            <input type="text"
                                   name="plan_name"
                                   class="form-control"
                                   value="{{ old('plan_name') }}"
                                   placeholder="Enter Plan Name">
                        </div>

                        <div class="form-group">
                            <label>Price (₹)</label>
                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price') }}"
                                   placeholder="Enter Price">
                        </div>

                        <div class="form-group">
                            <label>Duration (Days)</label>
                            <input type="number"
                                   name="duration"
                                   class="form-control"
                                   value="{{ old('duration') }}"
                                   placeholder="30">
                        </div>

                        <div class="form-group">
                            <label>Maximum Projects</label>
                            <input type="number"
                                   name="max_projects"
                                   class="form-control"
                                   value="{{ old('max_projects') }}"
                                   placeholder="10">
                        </div>

                        <div class="form-group">
                            <label>Maximum Team Members</label>
                            <input type="number"
                                   name="max_team_members"
                                   class="form-control"
                                   value="{{ old('max_team_members') }}"
                                   placeholder="20">
                        </div>

                        <div class="form-group">
                            <label>Storage Limit</label>
                            <input type="text"
                                   name="storage_limit"
                                   class="form-control"
                                   value="{{ old('storage_limit') }}"
                                   placeholder="2 GB">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea
                                name="description"
                                rows="4"
                                class="form-control"
                                placeholder="Enter Description">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="Active">Active</option>

                                <option value="Inactive">Inactive</option>

                            </select>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Plan
                        </button>

                        <a href="{{ route('admin.subscriptions.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </section>



@endsection