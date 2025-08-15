<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'model_type' => 'App\\Models\\Page',
            'model_id' => 1,
            'uuid' => Str::uuid()->toString(),
            'collection_name' => 'default',
            'name' => $this->faker->word(),
            'file_name' => $this->faker->word().'.jpg',
            'mime_type' => 'image/jpeg',
            'disk' => 'public',
            'size' => 1000,
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => 0,
        ];
    }
}
