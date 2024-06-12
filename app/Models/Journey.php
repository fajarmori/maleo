<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journey extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'event',
        'site',
        'application',
        'origin',
        'destination',
        'date',
        'transportation',
        'employee_id',
    ];

    public function employee(): Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    
}
