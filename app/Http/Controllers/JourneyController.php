<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Journey;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\JourneyRequest;

class JourneyController extends Controller
{
    public function index()
    {
        $journey = new Journey();
        Gate::authorize('showJourney', $journey);

        $journeys = Journey::query()->latest('id')->get();
        return view('journey.index',['journeys' => $journeys]);
    }

    public function create($employee_id)
    {
        $journey = new Journey();
        Gate::authorize('crudJourney', $journey);
        
        $employee = Employee::select('name','mria')->where('id',$employee_id)->first();
        return view('journey.form',[
            'journey' => $journey,
            'page_meta' => collect([
                'title' => 'Create a journey '.$employee->name.' (MRIA-'.substr(10000+$employee->mria,-4).') ',
                'method' => 'post',
                'url' => route('journeys.store',['employee' => $employee_id]),
            ]),
        ]);
    }

    public function store(JourneyRequest $request, $employee_id)
    {
        $journey = new Journey();
        Gate::authorize('crudJourney', $journey);

        $journey = Journey::create([
            'event' => str()->title($request->validated('event')),
            'site' => str()->title($request->validated('site')),
            'application' => $request->validated('application'),
            'origin' => str()->title($request->validated('origin')),
            'destination' => str()->title($request->validated('destination')),
            'date' => $request->validated('date'),
            'transportation' => str()->title($request->validated('transportation')),
            'employee_id' => $employee_id,
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created journey_id - '.$journey->id]);
        return to_route('journeys.index');
    }

    // public function show(Journey $journey)
    // {
    //     //
    // }

    public function edit(Journey $journey)
    {        
        Gate::authorize('crudJourney', $journey);

        $employee = Employee::select('name','mria')->where('id',$journey->employee_id)->first();
        return view('journey.form',[
            'journey' => $journey,
            'page_meta' => collect([
                'title' => 'Edit journey '.$employee->name.' (MRIA-'.substr(10000+$employee->mria,-4).') ',
                'method' => 'put',
                'url' => route('journeys.update',$journey),
            ]),
        ]);
    }

    public function update(JourneyRequest $request, Journey $journey)
    {
        Gate::authorize('crudJourney', $journey);

        $journey->update([
            'event' => str()->title($request->validated('event')),
            'site' => $request->validated('site'),
            'application' => $request->validated('application'),
            'origin' => str()->title($request->validated('origin')),
            'destination' => str()->title($request->validated('destination')),
            'date' => $request->validated('date'),
            'transportation' => str()->title($request->validated('transportation')),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated journey_id - '.$journey->id]);
        return to_route('journeys.index');
    }

    public function destroy(Journey $journey)
    {
        Gate::authorize('crudJourney', $journey);

        Journey::query()->where('id', $journey->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted journey_id - '.$journey->id]);
        return to_route('journeys.index');
    }
}
