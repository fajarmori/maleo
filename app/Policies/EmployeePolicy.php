<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    public function showEmployee(User $user, Employee $employee): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudEmployee(User $user, Employee $employee): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            return $user->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        default:
            return Response::denyAsNotFound();
        }
    }
}
