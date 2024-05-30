<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\SiteObserver;

#[ObservedBy(SiteObserver::class)]

class Site extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'owner',
        'slug',
        'district',
        'regency',
        'province',
        'description',
    ];
    
}
