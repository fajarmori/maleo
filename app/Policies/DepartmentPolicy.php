<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
    public function showDepartment(User $user, Department $department): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudDepartment(User $user, Department $department): Response
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
