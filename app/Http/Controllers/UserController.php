<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\DetailEmployee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $user = new User();
        Gate::authorize('allUser', $user);

        $users = User::query()->latest('id')->get();
        return view('auth.index',['users' => $users]);
    }

    public function edit(User $user)
    {
        Gate::authorize('allUser', $user);

        $departments = Department::query()->latest('id')->get();
        return view('auth.form',[
            'user' => $user,
            'departments' => $departments,
            'page_meta' => collect([
                'title' => 'Edit user',
                'method' => 'put',
                'url' => route('user.update', $user),
                'mria' => isset($user->detail->employee->mria) ? 'MRIA-'.substr((10000+$user->detail->employee->mria),-4) : NULL,
            ]),
        ]);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('allUser', $user);

        $request->validate([
            'name' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'email' => ['required', 'string', 'email', 'max:255', "regex:/(.*)@mria\.co\.id/i", Rule::unique('users','email')->ignore($user->id)],
        ]);

        $user->update([
            'name' => str()->title(str()->lower($request->name)),
            'email' => str()->lower($request->email),
            'type' => $request->type,
            'email_verified_at' => NULL,
            'department_id' => $request->department,
        ]);

        if(isset($request->mria)){
            $employee = Employee::query()->where('mria',intval(str()->substr($request->mria,-4)))->first();
            $employee->detail()->update(['user_id' => $user->id]);
        }else{
            $detail = DetailEmployee::query()->where('user_id',$user->id)->first();
            if(isset($detail)){
                $detail->update(['user_id' => NULL]);
            }
        }

        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'update user_id - '.$user->email]);
        return to_route('user.index');
    }

    public function destroy(User $user)
    {
        Gate::authorize('allUser', $user);
        
        User::query()->where('id', $user->id)->delete();
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted user email - '.$user->email]);
        return to_route('user.index');
    }
}
