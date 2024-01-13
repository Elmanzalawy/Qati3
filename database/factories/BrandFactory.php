<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $nameEn = fake()->sentence(),
                'ar' => fake()->sentence(),
            ],
            'description' => [
                'en' => fake()->randomHtml(10),
                'ar' => fake()->randomHtml(10),
            ],
            'slug' => Str::slug($nameEn),
            'boycott_status' => rand(1, count(Brand::BOYCOTT_STATUSES)),
            'is_visible' => fake()->boolean(),
            'parent_brand_id' => null,
            'established_at' => fake()->dateTime(),
        ];
    }
}
