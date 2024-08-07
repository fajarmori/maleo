<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Employee;
use App\Models\Occupation;
use App\Models\DetailEmployee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = new Employee();
        Gate::authorize('showEmployee', $employee);

        $employees = Employee::query()->latest('id')->get();
        return view('employee.index',['employees' => $employees]);
    }

    public function create()
    {
        $employee = new Employee();
        Gate::authorize('crudEmployee', $employee);

        $employee = Employee::latest('id')->first();
        $mria = $employee ? $employee->mria : 0;
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
        Gate::authorize('crudEmployee', $employee);

        $employee = Employee::create([
            'name' => $request->validated('name'),
            'nik' => $request->validated('nik'),
            'born' => $request->validated('born'),
            'birthday' => $request->validated('birthday'),
            'phone' => substr($request->validated('phone'),0,1) === '0' ? '62'.substr($request->validated('phone'),1) : $request->validated('phone'),
            'address' => $request->validated('address'),
        ]);

        $detail = new DetailEmployee(['employee_id' => $employee->id]);
        $employee->detail()->save($detail);
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created employee_id - '.$employee->id]);
        return to_route('employees.index');
    }

    public function show(Employee $employee)
    {
        Gate::authorize('showEmployee', $employee);

        $employee = Employee::query()->where('slug',$employee->slug)->first();
        return view('employee.show',['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        Gate::authorize('crudEmployee', $employee);

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
        Gate::authorize('crudEmployee', $employee);
        
        $employee->update([
            'name' => $request->validated('name'),
            'nik' => $request->validated('nik'),
            'born' => $request->validated('born'),
            'birthday' => $request->validated('birthday'),
            'phone' => substr($request->validated('phone'),0,1) === '0' ? '62'.substr($request->validated('phone'),1) : $request->validated('phone'),
            'address' => $request->validated('address'),
        ]);

        $request->validate([
            'join' => ['required', 'date'],
            'email' => ['nullable', 'string', 'email', 'max:255', "regex:/^[\w\s.@_]*$/", Rule::unique('detail_employees','email')->ignore($employee->detail->id)],
            'occupation_id' => [Rule::exists('occupations','id')],
        ]);
        
        $employee->detail()->update([
            'email' => str()->lower($request->email),
            'join' => $request->join,
            'resign' => $request->resign,
            'occupation_id' => is_numeric($request->occupation) ? $request->occupation : NULL,
        ]);

        if(isset($request->resign)){
            if(isset($employee->detail->user_id)){
                $user = User::query()->where('id', $employee->detail->user_id)->delete();
                $employee->detail()->update(['user_id' => NULL]);
                Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted user_id - '.$employee->detail->user_id]);
            }
        }
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated employee_id - '.$employee->id]);
        return to_route('employees.show',['employee' => $employee]);
    }
    
    public function destroy(Employee $employee)
    {
        Gate::authorize('crudEmployee', $employee);

        Employee::query()->where('slug', $employee->slug)->delete();
        if(isset($employee->detail->user_id)){
            $user = User::query()->where('id', $employee->detail->user_id)->delete();
            $employee->detail()->update(['user_id' => NULL]);
            Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted user_id - '.$employee->detail->user_id]);
        }
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted employee_id - '.$employee->id]);
        return to_route('employees.index');
    }
}
