<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectFile;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\FileVersion;

class ProjectFileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {

            $files = ProjectFile::with(['project', 'uploader'])
                ->latest()
                ->get();
        } elseif ($user->role == 'client') {

            $files = ProjectFile::with(['project', 'uploader'])
                ->whereHas('project', function ($q) use ($user) {
                    $q->where('client_id', $user->id);
                })
                ->latest()
                ->get();
        } else {

            $files = ProjectFile::with(['project', 'uploader'])
                ->whereHas('project.members', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->get();
        }

        return view('project-files.index', compact('files'));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'freelancer'])) {
            abort(403);
        }

        if (Auth::user()->role == 'admin') {

            $projects = Project::all();
        } else {

            $projects = Project::whereHas('members', function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        }

        return view('project-files.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'file_name'  => 'required',
            'file'       => 'required|mimes:pdf,xlsx,xls,jpg,jpeg,png,zip|max:20480',
        ]);
        if (!in_array(Auth::user()->role, ['admin', 'freelancer'])) {
            abort(403);
        }
        $file = $request->file('file');

        $path = $file->store('project_files', 'public');

        ProjectFile::create([
            'project_id'    => $request->project_id,
            'uploaded_by'   => Auth::id(),
            'file_name'     => $request->file_name,
            'original_name' => $file->getClientOriginalName(),
            'file_type'     => $file->getClientOriginalExtension(),
            'file_size'     => $file->getSize(),
            'file_path'     => $path,
            'version'       => 1,
            'description'   => $request->description,
        ]);

        return redirect()
            ->route('project-files.index')
            ->with('success', 'File Uploaded Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $file = ProjectFile::findOrFail($id);

        $file->delete();

        return redirect()
            ->route('project-files.index')
            ->with('success', 'File Moved To Trash Successfully');
    }

    public function download($id)
    {
        $file = ProjectFile::findOrFail($id);
        $user = Auth::user();

        if (
            $user->role != 'admin' &&
            !$file->project->members()->where('user_id', $user->id)->exists() &&
            $file->project->client_id != $user->id
        ) {
            abort(403);
        }
        $path = storage_path('app/public/' . $file->file_path);

        return response()->download(
            $path,
            $file->original_name
        );
    }

    public function preview($id)
    {
        $file = ProjectFile::findOrFail($id);

        $path = storage_path('app/public/' . $file->file_path);

        return response()->file($path);
    }

    public function trash()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        $files = ProjectFile::onlyTrashed()
            ->with(['project', 'uploader'])
            ->latest()
            ->get();

        return view('project-files.trash', compact('files'));
    }
    public function restore($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }
        $file = ProjectFile::onlyTrashed()
            ->findOrFail($id);

        $file->restore();

        return redirect()
            ->route('project-files.trash')
            ->with('success', 'File Restored Successfully');
    }

    public function uploadNewVersion(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['admin', 'freelancer'])) {
            abort(403);
        }
        $request->validate([
            'file' => 'required|mimes:pdf,xlsx,xls,jpg,jpeg,png,zip|max:20480',
        ]);

        $projectFile = ProjectFile::findOrFail($id);

        FileVersion::create([
            'project_file_id' => $projectFile->id,
            'uploaded_by'     => Auth::id(),
            'version'         => $projectFile->version,
            'file_path'       => $projectFile->file_path,
            'file_size'       => $projectFile->file_size,
        ]);

        $file = $request->file('file');

        $path = $file->store('project_files', 'public');

        $projectFile->update([
            'original_name' => $file->getClientOriginalName(),
            'file_type'     => $file->getClientOriginalExtension(),
            'file_size'     => $file->getSize(),
            'file_path'     => $path,
            'version'       => $projectFile->version + 1,
        ]);

        return redirect()
            ->route('project-files.index')
            ->with('success', 'New Version Uploaded Successfully');
    }

    public function versionForm($id)
    {
        $user = Auth::user();

        $file = ProjectFile::findOrFail($id);

        if (
            $user->role != 'admin' &&
            !$file->project->members()->where('user_id', $user->id)->exists()
        ) {
            abort(403);
        }

        return view('project-files.version', compact('file'));
    }
}
