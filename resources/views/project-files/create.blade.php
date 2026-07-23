@extends('adminlte::page')

@section('title', 'Upload Project File')

@section('content_header')
    <h1>Upload Project File</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('project-files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Project</label>
        <select name="project_id" class="form-control">
            <option value="">Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>File Title</label>
        <input type="text" name="file_name" class="form-control" value="{{ old('file_name') }}">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Upload File</label>
        <input type="file"
       name="file"
       id="fileInput"
       class="form-control">
        <small class="text-muted">
            Allowed: PDF, Excel, Images, ZIP
        </small>
    </div>
<div class="mb-3">

    <label>Drag & Drop File</label>

    <div id="drop-area"
         style="
            border:2px dashed #007bff;
            padding:40px;
            text-align:center;
            border-radius:10px;
            cursor:pointer;
         ">

        <p>Drag & Drop File Here</p>
        <p>OR</p>
        <p>Click To Select File</p>
<p id="file-name" class="mt-2 text-success"></p>
    </div>

</div>
    <button class="btn btn-primary">
        Upload File
    </button>
</form>
@section('js')

<script>

let dropArea = document.getElementById('drop-area');
let fileInput = document.getElementById('fileInput');

dropArea.addEventListener('click', () => {
    fileInput.click();
});

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
});

dropArea.addEventListener('drop', (e) => {

    e.preventDefault();

    fileInput.files = e.dataTransfer.files;

});
let fileName = document.getElementById('file-name');

fileInput.addEventListener('change', function () {

    if(this.files.length > 0){
        fileName.innerHTML =
            'Selected File: ' + this.files[0].name;
    }

});

dropArea.addEventListener('drop', (e) => {

    e.preventDefault();

    fileInput.files = e.dataTransfer.files;

    if(fileInput.files.length > 0){
        fileName.innerHTML =
            'Selected File: ' + fileInput.files[0].name;
    }

});
</script>

@stop
@stop