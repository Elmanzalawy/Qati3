<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public const BOYCOTT_STATUS_UNKNOWN = 'unknown';
    public const BOYCOTT_STATUS_NEUTRAL = 'neutral';
    public const BOYCOTT_STATUS_BOYCOTTED = 'boycotted';
    public const BOYCOTT_STATUS_SUPPORTED = 'supported';

    public const BOYCOTT_STATUSES = [
        0 => self::BOYCOTT_STATUS_UNKNOWN,
        1 => self::BOYCOTT_STATUS_NEUTRAL,
        2 => self::BOYCOTT_STATUS_BOYCOTTED,
        3 => self::BOYCOTT_STATUS_SUPPORTED,
    ];
}
