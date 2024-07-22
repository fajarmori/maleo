<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliverynote extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'letter',
        'date',
        'sender_id',
        'name_sender',
        'phone_sender',
        'recipient_id',
        'name_recipient',
        'phone_recipient',
        'date_recipient',
        'via',
        'estimated_delivery',
        'user_id',
        'notes',
    ];

    public function sender(): Relations\HasOne
    {
        return $this->hasOne(Droppoint::class, 'id', 'sender_id');
    }
    public function recipient(): Relations\HasOne
    {
        return $this->hasOne(Droppoint::class, 'id', 'recipient_id');
    }
    public function items(): Relations\HasMany
    {
        return $this->hasMany(Deliveryitem::class);
    }
    public function user(): Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function department(): Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function site(): Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}