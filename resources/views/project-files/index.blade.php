@extends('adminlte::page')

@section('title', 'All Files')

@section('content_header')
<h1>All Files</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('project-files.create') }}"
            class="btn btn-primary">
            Upload New File
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project</th>
                    <th>File Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Version</th>
                    <th>Uploaded By</th>
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

                    <td>
                        {{ round($file->file_size / 1024, 2) }} KB
                    </td>

                    <td>
                        V{{ $file->version }}
                    </td>

                    <td>
                        {{ $file->uploader->name ?? 'N/A' }}
                    </td>

                    <td>

                        <a href="{{ route('project-files.preview',$file->id) }}"
                            class="btn btn-info btn-sm">
                            Preview
                        </a>

                        <a href="{{ route('project-files.download',$file->id) }}"
                            class="btn btn-success btn-sm">
                            Download
                        </a>
                        <a href="{{ route('project-files.version.form', $file->id) }}"
                            class="btn btn-warning btn-sm">
                            New Version
                        </a>
                        <form action="{{ route('project-files.destroy',$file->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete File?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center">
                        No Files Found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop