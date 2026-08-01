@extends('adminlte::page')

@section('title', 'Edit Meeting')

@section('content_header')
    <h1>Edit Meeting</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header bg-warning">

        <h3 class="card-title">
            <i class="fas fa-edit"></i> Edit Meeting
        </h3>

    </div>

    <form action="{{ route('admin.meetings.update',$meeting->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Meeting Title <span class="text-danger">*</span></label>

                    <input type="text"
                           name="meeting_title"
                           class="form-control"
                           value="{{ old('meeting_title',$meeting->meeting_title) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Duration (Minutes)</label>

                    <select name="duration" class="form-control">

                        <option value="15" {{ $meeting->duration==15?'selected':'' }}>15 Minutes</option>

                        <option value="30" {{ $meeting->duration==30?'selected':'' }}>30 Minutes</option>

                        <option value="45" {{ $meeting->duration==45?'selected':'' }}>45 Minutes</option>

                        <option value="60" {{ $meeting->duration==60?'selected':'' }}>1 Hour</option>

                        <option value="90" {{ $meeting->duration==90?'selected':'' }}>1 Hour 30 Minutes</option>

                        <option value="120" {{ $meeting->duration==120?'selected':'' }}>2 Hours</option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Meeting Date</label>

                    <input type="date"
                           name="meeting_date"
                           class="form-control"
                           value="{{ old('meeting_date',$meeting->meeting_date) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Meeting Time</label>

                    <input type="time"
                           name="meeting_time"
                           class="form-control"
                           value="{{ old('meeting_time',$meeting->meeting_time) }}"
                           required>

                </div>

            </div>

            <div class="mb-3">

                <label>Meeting Description</label>

                <textarea
                    name="meeting_description"
                    rows="4"
                    class="form-control">{{ old('meeting_description',$meeting->meeting_description) }}</textarea>

            </div>

            <div class="mb-3">

                <label>Google Meet Link</label>

                <input type="url"
                       name="meeting_link"
                       class="form-control"
                       value="{{ old('meeting_link',$meeting->meeting_link) }}"
                       placeholder="https://meet.google.com/">

            </div>

            <div class="mb-3">

                <label>Meeting Password</label>

                <input type="text"
                       name="meeting_password"
                       class="form-control"
                       value="{{ old('meeting_password',$meeting->meeting_password) }}">

            </div>

            <div class="mb-3">

                <label>Select Participants</label>

                <select
                    name="participants[]"
                    class="form-control"
                    multiple
                    required>

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                            {{ in_array($user->id,$selectedParticipants) ? 'selected' : '' }}>

                            {{ $user->name }}
                            ({{ ucfirst($user->role) }})

                        </option>

                    @endforeach

                </select>

                <small class="text-muted">
                    Hold CTRL to select multiple users.
                </small>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update Meeting

            </button>

            <a href="{{ route('admin.meetings.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@stop