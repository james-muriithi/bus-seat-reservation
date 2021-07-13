<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupPoint extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'pickup_points';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pickup_point',
        'pickup_time',
        'status',
        'route_id',
        'landmark',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
