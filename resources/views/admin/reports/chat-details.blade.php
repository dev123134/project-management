@extends('adminlte::page')

@section('title','Chat Details')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2>

                <i class="fas fa-comments"></i>

                Chat Details

            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.reports.chat-usage-report') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <div class="card card-primary">

        <div class="card-header">

            <h3 class="card-title">

                Message Information

            </h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="30%">Sender</th>

                    <td>{{ optional($message->sender)->name }}</td>

                </tr>

                <tr>

                    <th>Receiver</th>

                    <td>{{ optional($message->receiver)->name }}</td>

                </tr>

                <tr>

                    <th>Message</th>

                    <td>{{ $message->message }}</td>

                </tr>

                <tr>

                    <th>Attachment</th>

                    <td>

                        @if($message->file)

                            <a href="{{ asset('uploads/'.$message->file) }}"
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

                    <td>{{ $message->created_at->format('d M Y') }}</td>

                </tr>

                <tr>

                    <th>Time</th>

                    <td>{{ $message->created_at->format('h:i A') }}</td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection