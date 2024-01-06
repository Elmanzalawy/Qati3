<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BrandService
{
    use AuthorizesRequests, ValidatesRequests;

    public function  __construct()
    {
        $this->authorizeResource(Brand::class);
    }
}
