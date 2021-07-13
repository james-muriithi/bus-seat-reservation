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

    protected $dates = [
        'reservation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'passenger_id',
        'route_id',
        'pickup_point_id',
        'reservation_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function pickup_point()
    {
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id');
    }

    public function getReservationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setReservationDateAttribute($value)
    {
        $this->attributes['reservation_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
