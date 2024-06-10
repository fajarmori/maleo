<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Occupation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department(): Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
