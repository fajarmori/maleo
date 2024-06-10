<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::query()->latest('id')->get();
        return view('journey.index',['journeys' => $journeys]);
    }

    public function create($employee)
    {
        dd('test');
        return view('journey.form',[
            'journey' => new Journey(),
            'employee_id' => request()->id,
            'page_meta' => collect([
                'title' => 'Create a journey',
                'method' => 'post',
                'url' => route('journeys.store'),
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Journey $journey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Journey $journey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journey $journey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journey $journey)
    {
        //
    }
}
