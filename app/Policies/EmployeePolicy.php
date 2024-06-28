<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    public function list(User $user, Employee $employee): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->detail->occupation->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crud(User $user, Employee $employee): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            return $user->detail->occupation->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        default:
            return Response::denyAsNotFound();
        }
    }
}
