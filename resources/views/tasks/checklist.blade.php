@extends('adminlte::page')

@section('title', 'Task Checklist')

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Task Checklist

        </h3>

    </div>

    <div class="card-body">

        <div class="mb-4">

            <h5>

                <strong>Task :</strong>

                {{ $task->title }}

            </h5>

        </div>

        <form action="{{ route('tasks.checklist.store',$task->id) }}"
            method="POST">

            @csrf

            <div class="row">

                <div class="col-md-10">

                    <input type="text"
                        name="title"
                        class="form-control"
                        placeholder="Enter Checklist Item"
                        required>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-success w-100">

                        <i class="fas fa-save"></i>

                        Save

                    </button>

                </div>

            </div>

        </form>

        <hr>

        <div class="table-responsive">

            <form action="{{ route('tasks.checklist.update',$task->id) }}"
                method="POST">

                @csrf

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th width="80">Done</th>

                            <th>Checklist</th>

                            <th width="150">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($checklists as $checklist)

                        <tr>

                            <td>

                                <input type="checkbox"
                                    name="completed[]"
                                    value="{{ $checklist->id }}"

                                    {{ $checklist->is_completed ? 'checked' : '' }}>

                            </td>

                            <td>

                                {{ $checklist->title }}

                            </td>

                            <td>

                                @if($checklist->is_completed)

                                <span class="badge bg-success">

                                    Completed

                                </span>

                                @else

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center">

                                No Checklist Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                @if($checklists->count())

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>

                    Update Checklist

                </button>

                @endif

            </form>
        </div>

    </div>

</div>

@endsection