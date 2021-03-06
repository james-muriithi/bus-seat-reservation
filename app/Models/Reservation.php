<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'reservations';

    public $appends = ['first_passenger'];

    protected $dates = [
        'travel_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref',
        'pickup_point_id',
        'trip_id',
        'travel_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id')->with('route','route.bus');
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class)
            ->using(ReservationSeat::class)
            ->as("reservation")
            ->withPivot("amount_paid", "ticket_number", "passenger_id");
    }

    public function pickup_point()
    {
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id');
    }

    public function drop_point()
    {
        return $this->belongsTo(DropOffPoint::class, 'drop_off_point_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservation_id');
    }

    public function getTravelDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }

    public function setTravelDateAttribute($value)
    {
        $this->attributes['reservation_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFirstPassengerAttribute()
    {
        return $this->seats[0]->reservation->passenger ?? '{}';
    }
}
