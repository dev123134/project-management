@extends('adminlte::page')

@section('title', 'Backup & Restore')

@section('content')

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Backup & Restore</h1>
            </div>

            <div class="col-sm-6">

                <div class="d-flex justify-content-end align-items-center flex-wrap">

                    <form action="{{ route('admin.backup.create') }}"
                        method="POST"
                        class="mr-2 mb-0">

                        @csrf

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-database"></i> Create Backup

                        </button>

                    </form>

                    <form action="{{ route('admin.backup.restore') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="d-flex align-items-center">

                        @csrf

                        <input type="file"
                            name="backup_file"
                            class="mr-2"
                            required>

                        <button type="submit"
                            class="btn btn-warning">

                            Restore

                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Available Backup Files

                </h3>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Backup File</th>
                                <th>Size</th>
                                <th>Date</th>
                                <th width="180">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($files as $file)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $file->getFilename() }}</td>

                                <td>{{ number_format($file->getSize()/1024,2) }} KB</td>

                                <td>{{ date('d-m-Y h:i A',$file->getCTime()) }}</td>

                                <td>

                                    <a href="{{ route('admin.backup.download',$file->getFilename()) }}"
                                        class="btn btn-success btn-sm">

                                        <i class="fas fa-download"></i>

                                    </a>

                                    <form action="{{ route('admin.backup.delete',$file->getFilename()) }}"
                                        method="POST"
                                        style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this backup?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    No Backup Files Available.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection