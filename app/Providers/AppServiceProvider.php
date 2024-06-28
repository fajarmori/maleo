<?php

namespace App\Providers;

use App\Models;
use App\Policies;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Models\Journey::class, Policies\JourneyPolicy::class);
        Gate::policy(Models\Employee::class, Policies\EmployeePolicy::class);
        Gate::policy(Models\Occupation::class, Policies\OccupationPolicy::class);
        Gate::policy(Models\Department::class, Policies\DepartmentPolicy::class);
    }
}
