<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Attendance extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'action',
        'time',
        'location_id',
        'location_name',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    
}
