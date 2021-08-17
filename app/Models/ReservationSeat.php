<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservationSeat extends Pivot
{
    use HasFactory;
    protected $table = "reservation_seat";

    public $appends = ["passenger"];

    protected $fillable = [
        'seat_id',
        'passenger_id',
        'reservation_id',
        'amount_paid',
        'ticket_number',
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }

    public function getPassengerAttribute()
    {
        return array_key_exists("passenger_id", $this->attributes)
            ?  Passenger::find($this->attributes["passenger_id"]) : "{}";
    }
}
