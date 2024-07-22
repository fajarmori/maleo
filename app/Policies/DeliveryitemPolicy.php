<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Deliveryitem;
use Illuminate\Auth\Access\Response;

class DeliveryitemPolicy
{
    public function showDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 6 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function createDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
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
    public function updateDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return $user->id === $deliveryitem->user_id ? Response::allow() : Response::denyAsNotFound();
            case 6:
                return Response::allow();
            default:
                return Response::denyAsNotFound();
            }
        default:
            return Response::denyAsNotFound();
        }
    }
    public function deleteDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            switch ($user->department_id){
            case 2:
                return $user->id === $deliveryitem->user_id ? Response::allow() : Response::denyAsNotFound();
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