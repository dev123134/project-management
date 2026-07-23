@extends('adminlte::page')

@section('title','Project Details')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Project Details
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="30%">Project Title</th>
                <td>{{ $project->title }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td>{{ $project->client->name ?? '-' }}</td>
            </tr>

            <tr>
                <th>Service Location</th>
                <td>{{ $project->service_location }}</td>
            </tr>

            <tr>
                <th>Nature of Work</th>
                <td>{{ $project->nature_of_work }}</td>
            </tr>

            <tr>
                <th>Work Details</th>
                <td>{{ $project->description }}</td>
            </tr>

            <tr>
                <th>Project Start Date</th>
                <td>{{ $project->start_date }}</td>
            </tr>

            <tr>
                <th>Deadline</th>
                <td>{{ $project->deadline }}</td>
            </tr>

            <tr>
                <th>Project Value</th>
                <td>₹ {{ number_format($project->budget) }}</td>
            </tr>

            <tr>
                <th>Billing Address</th>
                <td>{{ $project->billing_address }}</td>
            </tr>

            <tr>
                <th>Invoice Status</th>
                <td>{{ $project->invoice_status }}</td>
            </tr>

            <tr>
                <th>Payment Status</th>
                <td>{{ $project->payment_status }}</td>
            </tr>

            <tr>
                <th>Project Status</th>
                <td>{{ $project->status }}</td>
            </tr>

        </table>

        <br>

        <h4>Team Members</h4>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Sr No.</th>
                    <th>Name</th>

                </tr>

            </thead>

            <tbody>

                @forelse($project->members as $member)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $member->user->name }}</td>

                </tr>

                @empty

                <tr>

                    <td colspan="2" class="text-center">
                        No Team Members Found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <br>

        <h4>Milestones</h4>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Due Date</th>

                </tr>

            </thead>

            <tbody>

                @forelse($project->milestones as $milestone)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $milestone->title }}</td>

                    <td>{{ $milestone->status }}</td>

                    <td>{{ $milestone->due_date }}</td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center">
                        No Milestones Found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <br>

        <a href="{{ route('admin.project.monitoring.index') }}"
            class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

</div>

@endsection