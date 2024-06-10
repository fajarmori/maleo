<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journey extends Model
{
    protected $fillable = [
        'event',
        'site',
        'request',
        'origin',
        'destination',
        'date',
        'transportation',
    ];

    public function employee(): Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    
}
