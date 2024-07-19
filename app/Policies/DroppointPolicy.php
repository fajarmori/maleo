<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Droppoint;
use Illuminate\Auth\Access\Response;

class DroppointPolicy
{
    public function showDroppoint(User $user, Droppoint $droppoint): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 6 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudDroppoint(User $user, Droppoint $droppoint): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            return $user->department_id === 6 ? Response::allow() : Response::denyAsNotFound();
        default:
            return Response::denyAsNotFound();
        }
    }
}