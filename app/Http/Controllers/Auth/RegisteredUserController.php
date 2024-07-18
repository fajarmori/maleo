<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $user = new User();
        Gate::authorize('allUser', $user);

        $departments = Department::query()->latest('id')->get();
        return view('auth.register',['departments' => $departments]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        Gate::authorize('allUser', $user);

        $request->validate([
            'name' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'email' => ['required', 'string', 'email', 'max:255', "regex:/(.*)@mria\.co\.id/i", 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => str()->title($request->name),
            'email' => str()->lower($request->email),
            'type' => 2,
            'department_id' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        if(isset($request->mria)){
            $employee = Employee::query()->where('mria',intval(str()->substr($request->mria,-4)))->first();
            $employee->detail()->update(['user_id' => $user->id]);
        }

        return to_route('user.index');
    }
}