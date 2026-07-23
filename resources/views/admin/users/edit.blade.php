@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
<!-- <h1>Add User</h1> -->
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h2 class="">Edit User</h2>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        </div>

    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Full Name</label>

                        <input type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter Full Name">

                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Email Address</label>

                        <input type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Enter Email">

                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Password</label>

                        <input type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input type="password"
                            name="password_confirmation"
                            class="form-control">

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Role</label>

                        <select name="role"
                            class="form-control @error('role') is-invalid @enderror">

                            <option value="">Select Role</option>

                            <option value="admin"
{{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
Admin
</option>

                            <option value="freelancer" {{ old('role', $user->role)=='freelancer' ? 'selected' : '' }}>Freelancer</option>

                            <option value="employee" {{ old('role', $user->role)=='employee' ? 'selected' : '' }}>Employee</option>

                            <option value="client" {{ old('role', $user->role)=='client' ? 'selected' : '' }}>Client</option>

                        </select>

                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Status</label>

                        <select name="status"
                            class="form-control @error('status') is-invalid @enderror">

                           <option value="active"
{{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
Active
</option>

<option value="inactive"
{{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
Inactive
</option>

                        </select>

                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update User
            </button>

        </div>

    </form>

</div>

@stop