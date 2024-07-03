<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Employee;
use App\Models\DetailEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $user = new User();
        Gate::authorize('pageUser', $user);

        $users = User::query()->latest('id')->get();
        return view('auth.index',['users' => $users]);
    }

    public function edit(User $user)
    {
        Gate::authorize('pageUser', $user);

        return view('auth.form',[
            'user' => $user,
            'page_meta' => collect([
                'title' => 'Edit user',
                'method' => 'put',
                'url' => route('user.update', $user),
            ]),
        ]);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('pageUser', $user);

        $user->update([
            'name' => strpos($request->name,'|')?substr($request->name,0,strlen($request->name)-12):$request->name,
            'email' => $request->email,
            'type' => $request->type,
            'email_verified_at' => NULL,
        ]);

        $detail = DetailEmployee::query()->where('user_id',$user->id)->first();
        $detail = !$detail ?: $detail->update(['user_id' => NULL]);
        
        $employee = Employee::query()->where('mria',intval(substr($request->name,-4)))->first();
        if(isset($employee)){
            $employee->detail()->update([
                'user_id' => $user->id,
            ]);
        }

        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'update user_id - '.$user->email]);
        return to_route('user.index');
    }

    public function destroy(User $user)
    {
        Gate::authorize('pageUser', $user);
        
        User::query()->where('id', $user->id)->delete();
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted user email - '.$user->email]);
        return to_route('user.index');
    }
}
