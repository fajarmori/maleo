<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OccupationRequest;

class OccupationController extends Controller
{
    public function index()
    {
        $occupations = Occupation::query()->latest('id')->get();
        return view('occupation.index',['occupations' => $occupations]);
    }

    public function create()
    {
        $departments = Department::query()->latest('id')->get();
        return view('occupation.form',[
            'occupation' => new Occupation(),
            'departments' => $departments,
            'page_meta' => collect([
                'title' => 'Create a occupation',
                'method' => 'post',
                'url' => route('occupations.store'),
            ]),
        ]);
    }

    public function store(OccupationRequest $request)
    {
        Occupation::create([
            'name' => $request->validated('name'),
            'department_id' => $request->validated('department'),
        ]);
        return to_route('occupations.index');
    }

    // public function show(Occupation $occupation)
    // {
    //     //
    // }

    public function edit(Occupation $occupation)
    {
        $departments = Department::query()->latest('id')->get();
        return view('occupation.form',[
            'occupation' => $occupation,
            'departments' => $departments,
            'page_meta' => collect([
                'title' => 'Edit occupation',
                'method' => 'put',
                'url' => route('occupations.update', $occupation),
            ]),
        ]);
    }

    public function update(OccupationRequest $request, Occupation $occupation)
    {
        $occupation->update([
            'name' => $request->name,
            'department_id' => $request->department,
        ]);
        return to_route('occupations.index');
    }

    public function destroy(Occupation $occupation)
    {
        Occupation::query()->where('id', $occupation->id)->delete();
        return to_route('occupations.index');
    }
}