<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Bus extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'buses';

    protected $appends = [
        'images',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bus_name',
        'bus_reg_no',
        'bus_type_id',
        'max_seats',
        'status',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function bus_type()
    {
        return $this->belongsTo(BusType::class, 'bus_type_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'bus_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getImagesAttribute()
    {
        $files = $this->getMedia('images');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');

            $type = pathinfo($item->getPath(), PATHINFO_EXTENSION);
            if (file_exists($item->getPath())) {
                $data = file_get_contents($item->getPath());
                $item->path = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        });

        return $files;
    }

    public function seat_classes()
    {
        return $this->belongsToMany(BusSeatClass::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // scopes
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
