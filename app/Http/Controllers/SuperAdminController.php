<?php

namespace App\Http\Controllers;

use App\Models\uLog;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function logindex()
    {
        $logs = uLog::with('user')->latest()->paginate(20);
        return view('superadmin.index', compact('logs'));
    }
}
