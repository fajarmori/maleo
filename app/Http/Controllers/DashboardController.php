<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Journey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $startDate = Carbon::now()->isoFormat('Y-MM-DD');
        $endDate = Carbon::now()->addDays(14)->isoFormat('Y-MM-DD');
        $journeys = Journey::query()->whereBetween('date',[ $startDate, $endDate])->orderBy('date')->get();
        return view('dashboard',['journeys' => $journeys]);
    }
}
