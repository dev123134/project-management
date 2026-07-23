@extends('adminlte::page')

@section('title', 'Group Chat Monitoring')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Group Chat Monitoring
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Group Name</th>
                    <th>Total Members</th>
                    <th>Total Messages</th>
                    <th>Created Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($groups as $group)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $group->name }}</td>

                    <td>{{ $group->members_count }}</td>

                    <td>{{ $group->messages_count }}</td>

                    <td>{{ $group->created_at->format('d M Y') }}</td>

                    <td>

                        <a href="{{ route('admin.chat.group.view', $group->id) }}"
                            class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Groups Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection