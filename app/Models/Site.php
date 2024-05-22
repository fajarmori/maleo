<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
