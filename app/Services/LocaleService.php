<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LocaleService
{
    public const LOCALE_LIST = [
        'en',
        'ar'
    ];
}
