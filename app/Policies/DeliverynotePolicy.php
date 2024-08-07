<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Deliverynote;
use Illuminate\Auth\Access\Response;

class DeliverynotePolicy
{
    public function showDeliverynote(User $user, Deliverynote $deliverynote): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            switch ($user->department_id){
            case 2:
                if($user->site->id == $deliverynote->sender->site->id){
                    return Response::allow();
                } elseif($user->site->id == $deliverynote->recipient->site->id){
                    return Response::allow();
                } else {
                    return Response::denyAsNotFound();
                }
            case 6:
                return Response::allow();
            default:
                if($user->department_id == $deliverynote->sender->department->id){
                    return Response::allow();
                } elseif($user->department_id == $deliverynote->recipient->department->id){
                    return Response::allow();
                } else {
                    foreach($deliverynote->items as $item){
                        if($item->department_id == auth()->user()->department_id){
                            return Response::allow();
                            break;
                        }
                    }
                    return Response::denyAsNotFound();
                }
            }
        }
    }
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
                return $user->id === $deliverynote->user_id ? Response::allow() : Response::denyAsNotFound();
            case 6:
                return Response::allow();
            default:
                return Response::denyAsNotFound();
            }
        default:
            return Response::denyAsNotFound();
        }
    }
    public function confirmDeliverynote(User $user, Deliverynote $deliverynote): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return $user->id === $deliverynote->recipient->site->user->id ? Response::allow() : Response::denyAsNotFound();
            case 6:
                return Response::allow();
            default:
                return $user->department->id === $deliverynote->recipient->department->id ? Response::allow() : Response::denyAsNotFound();
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
                return $user->id === $deliverynote->user_id ? Response::allow() : Response::denyAsNotFound();
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
