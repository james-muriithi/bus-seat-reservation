<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SystemSetting extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'system_settings';

    protected $appends = [
        'company_logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'default_currency_id',
        'company_name',
        'smtp_username',
        'smtp_host',
        'smtp_password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function default_currency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }

    public function getCompanyLogoAttribute()
    {
        $logo = $this->getMedia('company_logo')->last();
        if ($logo) {
            $logo->url = $logo->getUrl();
            $logo->thumbnail = $logo->getUrl('thumb');
            $logo->preview = $logo->getUrl('preview');

            $type = pathinfo($logo->getPath(), PATHINFO_EXTENSION);
            if (file_exists($logo->getPath())) {
                $data = file_get_contents($logo->getPath());
                $logo->path = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }
        return $logo;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
