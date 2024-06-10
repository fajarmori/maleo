<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function creating(Employee $employee): void 
    {
        $data = Employee::latest('id')->first();
        $data ? $mria = $employee->mria : $mria = 0;
        $employee->mria = $mria+1;
    }
}
