<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropOffPoint extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'drop_off_points';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'drop_off_point',
        'drop_time',
        'landmark',
        'address',
        'route_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
