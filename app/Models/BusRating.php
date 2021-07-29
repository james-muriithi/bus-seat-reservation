<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusRating extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'bus_ratings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_quality',
        'punctuality',
        'staff_behaviour',
        'comment',
        'rated_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function rated_by()
    {
        return $this->belongsTo(Passenger::class, 'rated_by_id');
    }
}
