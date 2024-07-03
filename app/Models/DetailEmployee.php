<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailEmployee extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id',
    ];

    public function employee(): Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function occupation(): Relations\BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }
}
