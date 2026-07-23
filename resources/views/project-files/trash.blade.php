@extends('adminlte::page')

@section('title', 'Trash Files')

@section('content_header')
    <h1>Trash Files</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project</th>
                    <th>File Name</th>
                    <th>Type</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($files as $file)

                <tr>

                    <td>{{ $file->id }}</td>

                    <td>{{ $file->project->title ?? 'N/A' }}</td>

                    <td>{{ $file->file_name }}</td>

                    <td>{{ $file->file_type }}</td>

                    <td>{{ $file->deleted_at }}</td>

                    <td>

                        <form action="{{ route('project-files.restore',$file->id) }}"
                              method="POST">

                            @csrf

                            <button class="btn btn-success btn-sm">
                                Restore
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center">
                        No Trash Files Found
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop