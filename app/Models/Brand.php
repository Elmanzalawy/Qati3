<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasFactory;

    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'boycott_status',
        'is_visible',
        'parent_brand_id',
        'established_at',
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
}
