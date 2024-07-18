<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee): void 
    {
        do{
            $slug = str()->random(40);
            $check = Employee::where('slug', $slug)->first();
        } while (isset($check));
        $employee->slug = $slug;
        $employee->name = str()->title($employee->name);
        
        $data = Employee::latest('id')->first();
        $data ? $mria = $data->mria : $mria = 0;
        $employee->mria = $mria+1;
        $employee->born = str()->title($employee->born);
        $employee->address = str()->ucfirst($employee->address);
    }
    public function updating(Employee $employee): void 
    {
        $employee->born = str()->title($employee->born);
    }
}
