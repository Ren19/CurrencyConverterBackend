<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::all();
        return response()->json($logs);
    }

    public static function logAction($action, $table_name, $record_id, $old_value = null, $new_value = null)
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'table_name' => $table_name,
            'record_id' => $record_id,
            'old_value' => $old_value,
            'new_value' => $new_value,
        ]);
    }
}
