<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'log',
    ];

    public function user(): Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
