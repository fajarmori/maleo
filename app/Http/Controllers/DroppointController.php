<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Droppoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DroppointRequest;

class DroppointController extends Controller
{
    public function index()
    {
        $droppoints = Droppoint::query()->latest()->get();
        return view('droppoint.index',['droppoints' => $droppoints]);
    }

    public function create()
    {
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
        $droppoint = Droppoint::create($request->validated());
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }

    // public function show(Droppoint $droppoint)
    // {
    //     //
    // }

    public function edit(Droppoint $droppoint)
    {
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
        $droppoint->update($request->validated());
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }

    public function destroy(Droppoint $droppoint)
    {
        $droppoint->update(['name' => 'DEL-'.$droppoint->name]);
        Droppoint::query()->where('id', $droppoint->id)->delete();
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted droppoint_id - '.$droppoint->id]);
        return to_route('droppoints.index');
    }
}
