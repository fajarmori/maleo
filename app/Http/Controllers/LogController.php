<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function __invoke()
    {
        if(auth()->user()->type === 0){
            $logs = Log::query()->latest()->get();
            return view('log.index',['logs' => $logs]);
        }
        else{return abort(404);}
    }
}
