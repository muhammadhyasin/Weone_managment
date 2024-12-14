<?php

namespace App\Http\Controllers;

use App\Models\uLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function logindex()
    {
        $logs = uLog::with('user')->latest()->paginate(100);
        return view('superadmin.index', compact('logs'));
    }
    public function clearLogs()
    {
        try {
            $logs = uLog::all();

            if ($logs->isEmpty()) {
                return redirect()->back()->with('info', 'No logs to save or clear.');
            }

            $logData = $logs->map(function ($log) {
                return [
                    'user' => $log->user->name ?? 'System',
                    'action' => $log->action,
                    'module' => $log->module,
                    'details' => $log->details,
                    'created_at' => $log->created_at->toDateTimeString(),
                ];
            });

            $fileName = 'logs_backup_' . now()->format('Y_m_d_H_i_s') . '.json';
            Storage::disk('local')->put($fileName, $logData->toJson(JSON_PRETTY_PRINT));

            uLog::truncate();

            return redirect()->back()->with([
                'success' => 'Logs have been saved and cleared successfully.',
                'backup_file' => $fileName,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear logs: ' . $e->getMessage());
        }
    }

}
