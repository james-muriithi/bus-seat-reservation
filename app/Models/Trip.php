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

    public $table = 'trips';

    protected $dates = [
        'travel_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'trip',
        'route_id',
        'travel_date',
        'status',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function getTravelDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTravelDateAttribute($value)
    {
        $this->attributes['travel_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
