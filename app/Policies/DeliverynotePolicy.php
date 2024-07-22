<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Deliverynote;
use Illuminate\Auth\Access\Response;

class DeliverynotePolicy
{
    public function createDeliverynote(User $user, Deliverynote $deliverynote): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return Response::allow();
            case 6:
                return Response::allow();
            default:
                return Response::denyAsNotFound();
            }
        default:
            return Response::denyAsNotFound();
        }
    }
    public function updateDeliverynote(User $user, Deliverynote $deliverynote): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return Response::allow();
            case 6:
                return Response::allow();
            default:
                return Response::denyAsNotFound();
            }
        default:
            return Response::denyAsNotFound();
        }
    }
    public function deleteDeliverynote(User $user, Deliverynote $deliverynote): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return Response::allow();
            case 6:
                return Response::allow();
            default:
                return Response::denyAsNotFound();
            }
        default:
            return Response::denyAsNotFound();
        }
    }
}
