<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliveryitem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'deliverynote_id',
        'code',
        'name',
        'quantity',
        'unit',
        'bale',
        'price',
        'notes',
        'purchase_order',
        'date_request',
    ];
    public function deliverynote(): Relations\BelongsTo
    {
        return $this->belongsTo(Deliverynote::class);
    }
}
