<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'boycott_status',
        'is_visible',
        'parent_brand_id',
        'established_at',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public $translatable = ['name', 'description'];

    public const BOYCOTT_STATUS_UNKNOWN = 'Unknown';
    public const BOYCOTT_STATUS_NEUTRAL = 'Neutral';
    public const BOYCOTT_STATUS_BOYCOTTED = 'Boycotted';
    public const BOYCOTT_STATUS_SUPPORTED = 'Supported';

    public const BOYCOTT_STATUSES = [
        0 => self::BOYCOTT_STATUS_UNKNOWN,
        1 => self::BOYCOTT_STATUS_NEUTRAL,
        2 => self::BOYCOTT_STATUS_BOYCOTTED,
        3 => self::BOYCOTT_STATUS_SUPPORTED,
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function getLogoAttribute()
    {
        return $this->getFirstMedia()->getUrl('preview');
    }

    // parent brand
    public function parent()
    {
        return $this->belongsTo(Brand::class, 'parent_id', 'id');
    }

    // child brands
    public function subsidiaries()
    {
        return $this->hasMany(Brand::class, 'parent_id', 'id');
    }
}
