<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Deliveryitem;
use Illuminate\Auth\Access\Response;

class DeliveryitemPolicy
{
    public function listDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            $departmentID = $user->detail->occupation->department_id ?? 6;
            return $departmentID === 6 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudDeliveryitem(User $user, Deliveryitem $deliveryitem): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            $departmentID = $user->detail->occupation->department_id ?? 6;
            return $departmentID === 6 ? Response::allow() : Response::denyAsNotFound();
        default:
            return Response::denyAsNotFound();
        }
    }
}
