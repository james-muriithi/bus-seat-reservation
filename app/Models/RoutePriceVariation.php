<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoutePriceVariation extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'route_price_variations';

    public $appends = ["seatClassesFare"];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pickup_point_id',
        'drop_point_id',
        'fare',
        'route_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function pickup_point()
    {
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id');
    }

    public function drop_point()
    {
        return $this->belongsTo(DropOffPoint::class, 'drop_point_id');
    }

    public function variation_seat_classes()
    {
        return $this->belongsToMany(BusSeatClass::class)->withPivot('fare');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getSeatClassesFareAttribute()
    {
        $seatClasses = $this->variation_seat_classes->map(function ($seatClass) {
            $seatClass->fare = $this->fare;
            $seatClass->currencyCode = defaultCurrrency();
            return $seatClass;
        });

        if ($this->variation_seat_classes->count() > 0) {
            return $seatClasses->merge($this->variation_seat_classes->map(function ($seatClass) {
                $seatClass->fare = floatval(data_get($seatClass, 'pivot.fare') ?? null);
                $seatClass->currencyCode = defaultCurrrency();
                return $seatClass;
            }));
        } else {
            return $seatClasses;
        }
    }
}
