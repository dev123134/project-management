@extends('adminlte::page')

@section('title', 'Upload New Version')

@section('content_header')
    <h1>Upload New Version</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <h5>
            Current File:
            {{ $file->file_name }}
        </h5>

        <h5>
            Current Version:
            V{{ $file->version }}
        </h5>

        <form action="{{ route('project-files.version', $file->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label>Select New File</label>

                <input type="file"
                       name="file"
                       class="form-control">

            </div>

            <button class="btn btn-primary">
                Upload New Version
            </button>

        </form>

    </div>

</div>

@stop