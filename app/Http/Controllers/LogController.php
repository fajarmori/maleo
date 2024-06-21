<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function __invoke()
    {
        $logs = Log::query()->latest()->get();
        return view('log.index',['logs' => $logs]);
    }
}
