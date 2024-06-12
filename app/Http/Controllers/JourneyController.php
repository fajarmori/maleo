<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JourneyRequest;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::query()->latest('id')->get();
        return view('journey.index',['journeys' => $journeys]);
    }

    public function create($employee_id)
    {
        $employee = Employee::select('name','mria')->where('id',$employee_id)->first();
        return view('journey.form',[
            'journey' => new Journey(),
            'page_meta' => collect([
                'title' => 'Create a journey '.$employee->name.' (MRIA-'.substr(10000+$employee->mria,-4).') ',
                'method' => 'post',
                'url' => route('journeys.store',['employee' => $employee_id]),
            ]),
        ]);
    }

    public function store(JourneyRequest $request, $employee_id)
    {
        Journey::create([
            'event' => $request->validated('event'),
            'site' => $request->validated('site'),
            'application' => $request->validated('application'),
            'origin' => $request->validated('origin'),
            'destination' => $request->validated('destination'),
            'date' => $request->validated('date'),
            'transportation' => $request->validated('transportation'),
            'employee_id' => $employee_id,
        ]);
        return to_route('journeys.index');
    }

    // public function show(Journey $journey)
    // {
    //     //
    // }

    public function edit(Journey $journey)
    {
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
        $journey->update([
            'event' => $request->event,
            'site' => $request->site,
            'application' => $request->application,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
            'transportation' => $request->transportation,
        ]);
        return to_route('journeys.index');
    }

    public function destroy(Journey $journey)
    {
        Journey::query()->where('id', $journey->id)->delete();
        return to_route('journeys.index');
    }
}
