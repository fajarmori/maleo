<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Site;
use Illuminate\Auth\Access\Response;

class SitePolicy
{
    public function showSite(User $user, Site $site): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        default:
            return $user->department_id === 3 ? Response::allow() : Response::denyAsNotFound();
        }
    }
    public function crudSite(User $user, Site $site): Response
    {
        switch ($user->type){
        case 0:
            return Response::allow();
        case 1:
            return $user->department_id === 3 ? Response::allow() : Response::denyAsNotFound();
        default:
            return Response::denyAsNotFound();
        }
    }
}