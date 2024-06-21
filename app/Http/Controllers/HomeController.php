<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Journey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $startDate = Carbon::now()->isoFormat('Y-MM-DD');
        $endDate = Carbon::now()->addDays(7)->isoFormat('Y-MM-DD');
        $countJourney = Journey::all()->whereBetween('date',[ $startDate, $endDate])->count();
        return view('home',compact(['countJourney']));
    }
}
