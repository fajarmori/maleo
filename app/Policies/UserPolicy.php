<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function allUser(User $user): Response
    {
        return $user->type === 0 ? Response::allow() : Response::denyAsNotFound();
    }
}
