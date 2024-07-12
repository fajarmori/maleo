<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Deliverynote;
use Illuminate\Auth\Access\Response;

class DeliverynotePolicy
{
    // public function listDeliverynote(User $user, Deliverynote $deliverynote): Response
    // {
    //     switch ($user->type){
    //     case 0:
    //         return Response::allow();
    //     default:
    //         if(isset($user->detail->occupation->department_id)){
    //             return $user->detail->occupation->department_id === 6 ? Response::allow() : Response::denyAsNotFound();
    //         }else{
    //             return substr($user->detail,0,8) === 'sitemria' ? Response::allow() : Response::denyAsNotFound();
    //         }
    //     }
    // }
    public function crudDeliverynote(User $user, Deliverynote $deliverynote): Response
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
