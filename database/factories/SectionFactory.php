<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'type' => 'text',
            'content' => [],
            'order' => 0,
        ];
    }
}
