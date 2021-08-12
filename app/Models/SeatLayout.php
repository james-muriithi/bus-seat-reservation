<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatLayout extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'seat_layouts';

    public $casts = [
        'details' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_id',
        'rows',
        'columns',
        'details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // mutators
    public function setDetailsAttribute($value)
    {
        $this->attributes['details'] = json_encode($value);
    }
}
