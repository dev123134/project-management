@extends('adminlte::page')

@section('title', 'Schedule Meeting')

@section('content_header')
<h1>Schedule Meeting</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">
            <i class="fas fa-video"></i> Schedule New Meeting
        </h3>

    </div>

    <form action="{{ route('admin.meetings.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Meeting Title <span class="text-danger">*</span></label>

                    <input type="text"
                        name="meeting_title"
                        class="form-control"
                        value="{{ old('meeting_title') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Duration (Minutes)</label>

                    <select name="duration" class="form-control">

                        <option value="15">15 Minutes</option>
                        <option value="30" selected>30 Minutes</option>
                        <option value="45">45 Minutes</option>
                        <option value="60">1 Hour</option>
                        <option value="90">1 Hour 30 Minutes</option>
                        <option value="120">2 Hours</option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Meeting Date <span class="text-danger">*</span></label>

                    <input type="date"
                        name="meeting_date"
                        class="form-control"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('meeting_date') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Meeting Time <span class="text-danger">*</span></label>

                    <input type="time"
                        name="meeting_time"
                        class="form-control"
                        required>

                </div>

            </div>

            <div class="mb-3">

                <label>Meeting Description</label>

                <textarea
                    name="meeting_description"
                    rows="4"
                    class="form-control"
                    placeholder="Enter meeting agenda...">{{ old('meeting_description') }}</textarea>

            </div>

            <div class="mb-3">

                <label>Google Meet Link</label>

                <input type="url"
                    name="meeting_link"
                    class="form-control"
                    placeholder="https://meet.google.com/xxxx-xxxx-xxx"
                    value="{{ old('meeting_link') }}">

                <small class="text-muted">

                    Optional. You can add it later.

                </small>

            </div>

            <div class="mb-3">

                <label>Meeting Password</label>

                <input type="text"
                    name="meeting_password"
                    class="form-control"
                    value="{{ old('meeting_password') }}"
                    placeholder="Optional">

            </div>

            <div class="mb-3">

                <label>Select Participants <span class="text-danger">*</span></label>

                <select name="participants[]" class="form-control" multiple required>

                    @foreach($users as $user)

                    <option value="{{ $user->id }}">

                        {{ $user->name }}

                        ({{ ucfirst($user->role) }})

                    </option>

                    @endforeach

                </select>

                <small class="text-muted">

                    Hold CTRL to select multiple participants.

                </small>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-success">

                <i class="fas fa-save"></i>

                Schedule Meeting

            </button>

            <a href="{{ route('admin.meetings.index') }}"
                class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@stop