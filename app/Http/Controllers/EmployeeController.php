<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Employee;
use App\Models\Occupation;
use App\Models\DetailEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = new Employee();
        Gate::authorize('list', $employee);

        $employees = Employee::query()->latest('id')->get();
        return view('employee.index',['employees' => $employees]);
    }

    public function create()
    {
        $employee = new Employee();
        Gate::authorize('crud', $employee);

        $employee = Employee::latest('id')->first();
        $employee ? $mria = $employee->mria : $mria = 0;
        return view('employee.form',[
            'employee' => new Employee(),
            'page_meta' => collect([
                'title' => 'Create a employee (MRIA-'.substr((10000+$mria)+1, -4).')',
                'method' => 'post',
                'url' => route('employees.store'),
            ]),
        ]);
    }

    public function store(EmployeeRequest $request)
    {
        $employee = new Employee();
        Gate::authorize('crud', $employee);

        $employee = Employee::create($request->validated());
        $detail = new DetailEmployee(['employee_id' => $employee->id]);
        $employee->detail()->save($detail);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created employee_id - '.$employee->id]);
        return to_route('employees.index');
    }

    public function show(Employee $employee)
    {
        Gate::authorize('list', $employee);

        $employee = Employee::query()->where('slug',$employee->slug)->first();
        return view('employee.show',['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        Gate::authorize('crud', $employee);

        $occupations = Occupation::query()->latest('id')->get();
        return view('employee.form',[
            'employee' => $employee,
            'occupations' => $occupations,
            'page_meta' => collect([
                'title' => 'Edit employee (MRIA-'.substr(10000+$employee->mria, -4).')',
                'method' => 'put',
                'url' => route('employees.update', $employee),
            ]),
        ]);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        Gate::authorize('crud', $employee);
        
        $employee->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'born' => $request->born,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $employee->detail()->update([
            'email' => $request->email,
            'resign' => $request->resign,
            'occupation_id' => is_numeric($request->occupation) ? $request->occupation : NULL,
        ]);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated employee_id - '.$employee->id]);
        return to_route('employees.show',['employee' => $employee]);
    }
    
    public function destroy(Employee $employee)
    {
        Gate::authorize('crud', $employee);

        Employee::query()->where('slug', $employee->slug)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted employee_id - '.$employee->id]);
        return to_route('employees.index');
    }
}
