@extends('adminlte::page')

@section('title','All Projects')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            All Projects Monitoring
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>Sr No.</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Deadline</th>
                    <th>Budget</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($projects as $project)

                @php

                $total = \App\Models\Milestone::where('project_id',$project->id)->count();

                $completed = \App\Models\Milestone::where('project_id',$project->id)
                ->where('status','Completed')
                ->count();

                $progress = $total>0 ? round(($completed/$total)*100) : 0;

                @endphp

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $project->title }}</td>

                    <td>

                        @if($project->status=='Completed')

                        <span class="badge bg-success">
                            Completed
                        </span>

                        @elseif($project->status=='In Progress')

                        <span class="badge bg-warning">
                            In Progress
                        </span>

                        @else

                        <span class="badge bg-danger">
                            Pending
                        </span>

                        @endif

                    </td>

                    <td width="220">

                        <div class="progress">

                            <div class="progress-bar bg-success"
                                style="width: {{ $project->progress }}%;"

                                {{ $project->getAttribute('progress') }}%

                                </div>

                            </div>

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}

                    </td>

                    <td>

                        ₹ {{ number_format($project->budget) }}

                    </td>



                    <td>
                        <a href="/projects/edit/{{ $project->id }}"
                            class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>
                        <a href="{{ route('admin.project.monitoring.show',$project->id) }}"
                            class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>
                        <form action="{{ url('/admin/project-monitoring') . '/' . $project->id }}" method="POST" style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this project?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection