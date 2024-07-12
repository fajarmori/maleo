<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Droppoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DroppointRequest;

class DroppointController extends Controller
{
    public function index()
    {
        $droppoint = new Droppoint();
        Gate::authorize('listDroppoint', $droppoint);

        $droppoints = Droppoint::query()->latest()->get();
        return view('droppoint.index',['droppoints' => $droppoints]);
    }

    public function create()
    {
        $droppoint = new Droppoint();
        Gate::authorize('crudDroppoint', $droppoint);

        return view('droppoint.form',[
            'droppoint' => new Droppoint(),
            'page_meta' => collect([
                'title' => 'Create Drop Point Delivery',
                'method' => 'post',
                'url' => route('droppoints.store'),
            ]),
        ]);
    }

    public function store(DroppointRequest $request)
    {
        $droppoint = new Droppoint();
        Gate::authorize('crudDroppoint', $droppoint);

        $droppoint = Droppoint::create([
            'name' => strtoupper($request->validated('name')),
            'address' => $request->validated('address'),
            'notes' => $request->validated('notes'),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }

    // public function show(Droppoint $droppoint)
    // {
    //     //
    // }

    public function edit(Droppoint $droppoint)
    {
        Gate::authorize('crudDroppoint', $droppoint);

        return view('droppoint.form',[
            'droppoint' => $droppoint,
            'page_meta' => collect([
                'title' => 'Edit Drop Point Delivery',
                'method' => 'put',
                'url' => route('droppoints.update',$droppoint),
            ]),
        ]);
    }

    public function update(DroppointRequest $request, Droppoint $droppoint)
    {
        Gate::authorize('crudDroppoint', $droppoint);

        $droppoint->update([
            'name' => strtoupper($request->validated('name')),
            'address' => $request->validated('address'),
            'notes' => $request->validated('notes'),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }

    public function destroy(Droppoint $droppoint)
    {
        Gate::authorize('crudDroppoint', $droppoint);
        
        $droppoint->update(['name' => 'DEL-'.$droppoint->name]);
        Droppoint::query()->where('id', $droppoint->id)->delete();
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }
}
