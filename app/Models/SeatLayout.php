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
}
