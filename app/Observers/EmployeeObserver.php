<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee): void 
    {
        $employee->name = str()->headline($employee->name);

        $data = Employee::latest('id')->first();
        $data ? $mria = $data->mria : $mria = 0;
        $employee->mria = $mria+1;

        substr($employee->phone,0,1) == 0 ? $phone = '62'.substr($employee->phone,1) : $phone = $employee->phone;
        $employee->phone = $phone;

        do{
            $slug = str()->random(40);
            $check = Employee::where('slug', $slug)->first();
        } while (isset($check));
        $employee->slug = $slug;
    }
}
