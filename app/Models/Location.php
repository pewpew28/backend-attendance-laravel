<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Location extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'locations';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'address',
    ];

    /**
     * Relasi: 1 Location punya banyak QR Code
     */
    public function qrCodes()
    {
        return $this->hasMany(QrCode::class);
    }
}
