<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Droppoint extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'notes',
        'department_id',
        'site_id',
    ];

    public function department(): Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function site(): Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}