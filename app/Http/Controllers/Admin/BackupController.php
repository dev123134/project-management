<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    // Show Backup List
    public function index()
    {
        $path = storage_path('app/backups');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $files = collect(File::files($path))
                    ->sortByDesc(function ($file) {
                        return $file->getCTime();
                    });

        return view('admin.backup.index', compact('files'));
    }

    // Create Backup
    public function create()
{
    $database = env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
    $host     = env('DB_HOST');
    $port     = env('DB_PORT');

    $backupPath = storage_path('app/backups');

    if (!File::exists($backupPath)) {
        File::makeDirectory($backupPath, 0755, true);
    }

    $fileName = 'backup_' . date('Y_m_d_H_i_s') . '.sql';

    $filePath = $backupPath . DIRECTORY_SEPARATOR . $fileName;

    $mysqldump = 'C:\xampp\mysql\bin\mysqldump.exe';

    $command = "\"{$mysqldump}\" --user={$username} --password={$password} --host={$host} --port={$port} {$database} > \"{$filePath}\"";

    exec($command, $output, $result);

    if ($result === 0) {

        return redirect()
            ->route('admin.backup.index')
            ->with('success', 'Database Backup Created Successfully.');

    }

    return redirect()
        ->route('admin.backup.index')
        ->with('error', 'Failed to Create Database Backup.');
}

    // Download Backup
    public function download($file)
{
    $path = storage_path('app/backups/' . $file);

    if (!File::exists($path)) {

        return redirect()
            ->route('admin.backup.index')
            ->with('error', 'Backup file not found.');

    }

    return response()->download($path);
}

    // Delete Backup
   public function delete($file)
{
    $path = storage_path('app/backups/' . $file);

    if (!File::exists($path)) {

        return redirect()
            ->route('admin.backup.index')
            ->with('error', 'Backup file not found.');

    }

    File::delete($path);

    return redirect()
        ->route('admin.backup.index')
        ->with('success', 'Backup file deleted successfully.');
}

public function restore(Request $request)
{
    $request->validate([
        'backup_file' => 'required|file|mimes:sql',
    ]);

    $database = env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
    $host     = env('DB_HOST');
    $port     = env('DB_PORT');

    $mysql = 'C:\xampp\mysql\bin\mysql.exe';

    if (!File::exists($mysql)) {

        return redirect()
            ->route('admin.backup.index')
            ->with('error', 'mysql.exe not found.');

    }

    $file = $request->file('backup_file')->getRealPath();

    if (!file_exists($file)) {

        return redirect()
            ->route('admin.backup.index')
            ->with('error', 'Backup file not found.');

    }

    if (empty($password)) {

        $command = "\"{$mysql}\" --host={$host} --port={$port} --user={$username} {$database} < \"{$file}\"";

    } else {

        $command = "\"{$mysql}\" --host={$host} --port={$port} --user={$username} --password={$password} {$database} < \"{$file}\"";

    }

    exec($command . " 2>&1", $output, $result);

    if ($result == 0) {

        return redirect()
            ->route('admin.backup.index')
            ->with('success', 'Database Restored Successfully.');

    }

    return redirect()
        ->route('admin.backup.index')
        ->with('error', implode('<br>', $output));
}
}