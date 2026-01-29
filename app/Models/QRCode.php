<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class QrCode extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'qr_codes';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'location_id',
        'qr_data',
        'generated_at',
        'is_active',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Location
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
