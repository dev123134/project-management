@extends('adminlte::page')

@section('title','Group Chat Details')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-users"></i>

                Group Chat Details

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.group-chat-report') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Group Message Information

            </h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">User</th>
                    <td>{{ optional($groupMessage->user)->name }}</td>
                </tr>

                <tr>
                    <th>Group</th>
                    <td>{{ optional($groupMessage->group)->name }}</td>
                </tr>

                <tr>
                    <th>Message</th>
                    <td>{{ $groupMessage->message }}</td>
                </tr>

                <tr>

                    <th>Attachment</th>

                    <td>

                        @if($groupMessage->file)

                            <a href="{{ asset('uploads/'.$groupMessage->file) }}"
                               target="_blank"
                               class="btn btn-success btn-sm">

                                <i class="fas fa-download"></i>

                                View Attachment

                            </a>

                        @else

                            <span class="badge badge-secondary">

                                No Attachment

                            </span>

                        @endif

                    </td>

                </tr>

                <tr>
                    <th>Date</th>
                    <td>{{ $groupMessage->created_at->format('d M Y') }}</td>
                </tr>

                <tr>
                    <th>Time</th>
                    <td>{{ $groupMessage->created_at->format('h:i A') }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection