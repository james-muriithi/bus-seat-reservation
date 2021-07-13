<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'routes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_id',
        'board_point',
        'board_time',
        'drop_point',
        'drop_time',
        'fare',
        'status',
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
