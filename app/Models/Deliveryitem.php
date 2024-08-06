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
        'weight',
        'description',
        'purchase_order',
        'date_request',
        'department_id',
        'site_id',
        'user_id',
    ];
    public function deliverynote(): Relations\BelongsTo
    {
        return $this->belongsTo(Deliverynote::class);
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
