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
        'average-rating'
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

    public function ratings()
    {
        return $this->hasMany(BusRating::class, 'bus_id');
    }
    public function seat_classes()
    {
        return $this->belongsToMany(BusSeatClass::class);
    }
    public function seat_layout()
    {
        return $this->hasOne(SeatLayout::class, 'bus_id');
    }
    public function seats()
    {
        return $this->hasMany(Seat::class, 'bus_id');
    }

    //attributes
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

    public function getAverageRatingAttribute()
    {
        $ratings = $this->ratings;
        $totalRatings = $ratings->count();

        return [
            'avg_bus_rating' => $ratings->avg('bus_quality'),
            'avg_staff_rating' => $ratings->avg('staff_behaviour'),
            'avg_punctuality_rating' => $ratings->avg('punctuality'),
            'total_ratings' => $totalRatings,
            'bus_rating_groups' => [
                1 => [
                    'rating' => $ratings->where('bus_quality', '<', 2)->avg('bus_quality'),
                    'percent' => getPercent($ratings->where('bus_quality', '<', 2)->count(), $totalRatings)
                ],
                2 => [
                    'rating' => $ratings->where('bus_quality', '>=', 2)
                        ->where('bus_quality', '<', 3)->avg('bus_quality'),
                    'percent' => getPercent($ratings->where('bus_quality', '>=', 2)
                        ->where('bus_quality', '<', 3)->count(), $totalRatings)
                ],
                3 => [
                    'rating' => $ratings->where('bus_quality', '>=', 3)
                        ->where('bus_quality', '<', 4)->avg('bus_quality'),
                    'percent' => getPercent($ratings->where('bus_quality', '>=', 3)
                        ->where('bus_quality', '<', 4)->count(), $totalRatings)
                ],
                4 => [
                    'rating' => $ratings->where('bus_quality', '>=', 4)
                        ->where('bus_quality', '<', 5)->avg('bus_quality'),
                    'percent' => getPercent($ratings->where('bus_quality', '>=', 4)
                        ->where('bus_quality', '<', 5)->count(), $totalRatings)
                ],
                5 => [
                    'rating' => $ratings->where('bus_quality', 5)->avg('bus_quality'),
                    'percent' => getPercent($ratings->where('bus_quality', 5)->avg('bus_quality'), $totalRatings)
                ],
            ]
        ];
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
