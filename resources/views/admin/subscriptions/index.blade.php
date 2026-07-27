@extends('adminlte::page')

@section('title', 'Subscription Plans')

@section('content')


<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Subscription Plans</h1>
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.subscriptions.create') }}"
                    class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Plan
                </a>
            </div>

        </div>

    </div>
</section>

<section class="content">

    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    All Subscription Plans
                </h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped table-hover">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Plan Name</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Projects</th>
                                <th>Members</th>
                                <th>Storage</th>
                                <th>Status</th>
                                <th width="150">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($subscriptions as $subscription)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $subscription->plan_name }}</td>

                                <td>₹ {{ $subscription->price }}</td>

                                <td>{{ $subscription->duration }} Days</td>

                                <td>{{ $subscription->max_projects }}</td>

                                <td>{{ $subscription->max_team_members }}</td>

                                <td>{{ $subscription->storage_limit }}</td>

                                <td>

                                    @if($subscription->status == 'Active')

                                    <span class="badge badge-success">
                                        Active
                                    </span>

                                    @else

                                    <span class="badge badge-danger">
                                        Inactive
                                    </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('admin.subscriptions.edit',$subscription->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('admin.subscriptions.destroy',$subscription->id) }}"
                                        method="POST"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this subscription plan?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="9" class="text-center">
                                    No Subscription Plans Found.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>



@endsection