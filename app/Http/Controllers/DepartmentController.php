<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::query()->latest('id')->get();
        return view('department.index',['departments' => $departments]);
    }

    public function create()
    {
        return view('department.form',[
            'department' => new Department(),
            'page_meta' => collect([
                'title' => 'Create a department',
                'method' => 'post',
                'url' => route('departments.store'),
            ]),
        ]);
    }

    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());
        return to_route('departments.index');
    }

    // public function show(Department $department)
    // {
    //     $department = Department::query()->where('id',$department->id)->first();
    //     return view('department.show',['department' => $department]);
    // }

    public function edit(Department $department)
    {
        return view('department.form',[
            'department' => $department,
            'page_meta' => collect([
                'title' => 'Edit department',
                'method' => 'put',
                'url' => route('departments.update', $department),
            ]),
        ]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return to_route('departments.index');
    }

    public function destroy(Department $department)
    {
        Department::query()->where('id', $department->id)->delete();
        return to_route('departments.index');
    }
}
