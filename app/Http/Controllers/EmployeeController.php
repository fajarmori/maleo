<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Occupation;
use App\Models\DetailEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query()->latest('id')->get();
        return view('employee.index',['employees' => $employees]);
    }

    public function create()
    {
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
        $employee = Employee::create($request->validated());
        $detail = new DetailEmployee(['employee_id' => $employee->id]);
        $employee->detail()->save($detail);
        return to_route('employees.index');
    }

    public function show(Employee $employee)
    {
        $employee = Employee::query()->where('id',$employee->id)->first();
        return view('employee.show',['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
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
            'occupation_id' => $request->occupation,
        ]);
        return to_route('employees.show',['employee' => $employee]);
    }
    
    public function destroy(Employee $employee)
    {
        Employee::query()->where('id', $employee->id)->delete();
        return to_route('employees.index');
    }
}
