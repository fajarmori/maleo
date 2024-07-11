<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = new Department();
        Gate::authorize('listDepartment', $department);

        $departments = Department::query()->latest('id')->get();
        return view('department.index',['departments' => $departments]);
    }

    public function create()
    {
        $department = new Department();
        Gate::authorize('crudDepartment', $department);

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
        $department = new Department();
        Gate::authorize('crudDepartment', $department);

        $department = Department::create([
            'name' => ucwords(strtolower($request->validated('name'))),
            'code' => str()->upper($request->validated('code')),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created department_id - '.$department->id]);
        return to_route('departments.index');
    }

    // public function show(Department $department)
    // {
    //     $department = Department::query()->where('id',$department->id)->first();
    //     return view('department.show',['department' => $department]);
    // }

    public function edit(Department $department)
    {
        Gate::authorize('crudDepartment', $department);
        
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
        Gate::authorize('crudDepartment', $department);

        $department->update([
            'name' => ucwords(strtolower($request->validated('name'))),
            'code' => str()->upper($request->validated('code')),
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated department_id - '.$department->id]);
        return to_route('departments.index');
    }

    public function destroy(Department $department)
    {
        Gate::authorize('crudDepartment', $department);

        Department::query()->where('id', $department->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted department_id - '.$department->id]);
        return to_route('departments.index');
    }
}
