@extends('adminlte::page')

@section('title','Milestone Details')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-flag-checkered"></i>

                Milestone Details

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.milestone-report') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Milestone Information

            </h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="30%">Project</th>

                    <td>{{ $project->title }}</td>

                </tr>

                <tr>

                    <th>Milestone</th>

                    <td>{{ $milestone->title }}</td>

                </tr>

                <tr>

                    <th>Description</th>

                    <td>{{ $milestone->description }}</td>

                </tr>

                <tr>

                    <th>Due Date</th>

                    <td>{{ \Carbon\Carbon::parse($milestone->due_date)->format('d M Y') }}</td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        @if($milestone->status=='Completed')

                            <span class="badge badge-success">

                                Completed

                            </span>

                        @else

                            <span class="badge badge-warning">

                                Pending

                            </span>

                        @endif

                    </td>

                </tr>

            </table>

        </div>

    </div>

@endsection