<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'routes';

    public $appends = ['seatClassesFare', 'route_name'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_id',
        'board_point',
        'board_time',
        'drop_point',
        'drop_time',
        'fare',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function route_seat_classes()
    {
        return $this->belongsToMany(BusSeatClass::class)->withPivot('fare');
    }

    public function drop_off_points()
    {
        return $this->hasMany(DropOffPoint::class, 'route_id');
    }

    public function pickup_points()
    {
        return $this->hasMany(PickupPoint::class, 'route_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // attributes
    public function getSeatClassesFareAttribute()
    {
        $seatClasses = $this->bus->seat_classes->map(function ($seatClass) {
            $seatClass->fare = $this->fare;
            $seatClass->currencyCode = defaultCurrrency();
            return $seatClass;
        });

        if ($this->route_seat_classes->count() > 0) {
            return $seatClasses->merge($this->route_seat_classes->map(function ($seatClass) {
                $seatClass->fare = floatval(data_get($seatClass, 'pivot.fare') ?? null);
                $seatClass->currencyCode = defaultCurrrency();
                return $seatClass;
            }));
        } else {
            return $seatClasses;
        }
    }

    public function getFareAttribute()
    {
        return floatval($this->attributes['fare']);
    }

    public function getRouteNameAttribute()
    {
        return $this->board_point .'-'. $this->drop_point;
    }
}
