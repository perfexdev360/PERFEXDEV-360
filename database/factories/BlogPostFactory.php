<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();

        return [
            // Relations are attached via ->for(...) or helper states below
            'title'        => $title,
            'slug'         => Str::slug($title) . '-' . Str::lower(Str::random(6)),
            'body'         => $this->faker->paragraphs(3, true),
            'seo'          => [
                'meta_title'       => $this->faker->sentence(),
                'meta_description' => $this->faker->text(160),
            ],
            'is_published' => true,
            'published_at' => now(),
        ];
    }

    /**
     * Mark as draft (not published yet).
     */
    public function draft(): static
    {
        return $this->state(fn () => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    /**
     * Mark as published at a given time (now by default).
     */
    public function published(?\DateTimeInterface $at = null): static
    {
        return $this->state(fn () => [
            'is_published' => true,
            'published_at' => $at ?: now(),
        ]);
    }

    /**
     * Attach a category (existing or new via factory).
     */
    public function withCategory(?Category $category = null): static
    {
        return $this->for($category ?? Category::factory(), 'category');
    }

    /**
     * Attach an author (existing or new via factory).
     */
    public function withAuthor(?User $user = null): static
    {
        return $this->for($user ?? User::factory(), 'author');
    }
}
