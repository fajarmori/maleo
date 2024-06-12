<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\EmployeeObserver;

#[ObservedBy(EmployeeObserver::class)]

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'slug',
        'name',
        'mria',
        'nik',
        'born',
        'birthday',
        'phone',
        'address',
    ];

    public function journeys(): Relations\HasMany
    {
        return $this->hasMany(Journey::class);
    }

    public function detail(): Relations\HasOne
    {
        return $this->hasOne(DetailEmployee::class);
    }
}
