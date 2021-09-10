<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TRIP_STATUS = [
        0 => "Cancelled",
        1 => "Active",
        2 => "Departured"
    ];

    public $table = 'trips';

    public $appends = ["seat_classes_fare", "available_seat_count"];

    protected $dates = [
        'travel_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'trip_id',
        'route_id',
        'fare',
        'travel_date',
        'status',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id')->with("bus.seat_layout");
    }

    public function trip_seat_classes()
    {
        return $this->belongsToMany(BusSeatClass::class, 'bus_seat_class_trip', 'trip_id', 'bus_seat_class_id')
            ->withPivot('fare');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, "trip_id");
    }
    public function getTravelDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTravelDateAttribute($value)
    {
        $this->attributes['travel_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    // attributes
    public function getSeatClassesFareAttribute()
    {
        $seatClasses = $this->route->bus->seat_classes->map(function ($seatClass) {
            $seatClass->fare = $this->fare;
            $seatClass->currencyCode = defaultCurrrency();
            return $seatClass;
        });


        if ($this->trip_seat_classes->count() > 0) {
            return $seatClasses->merge($this->trip_seat_classes->map(function ($seatClass) {
                $seatClass->fare = floatval(data_get($seatClass, 'pivot.fare') ?? null);
                $seatClass->currencyCode = defaultCurrrency();
                return $seatClass;
            }));
        } else if ($this->route->route_seat_classes->count() > 0) {
            return $seatClasses->merge($this->route->route_seat_classes->map(function ($seatClass) {
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
        return !empty($this->attributes['fare']) ?  floatval($this->attributes['fare']) : $this->route->fare;
    }

    public function getBusAttribute()
    {
        return $this->route->bus;
    }

    public function getAvailableSeatCountAttribute()
    {
        $availableSeats = $this->bus->seats()
            ->notDisabled()
            ->get()
            ->count();

        $bookedSeats = $this->reservations->pluck('seats')
            ->flatten()
            ->count();
        return $availableSeats - $bookedSeats;
    }

    // scopes
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
