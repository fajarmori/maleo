<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Journey;
use Illuminate\Auth\Access\Response;

class JourneyPolicy
{
    public function showJourney(User $user, Journey $journey): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 4 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudJourney(User $user, Journey $journey): Response
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
