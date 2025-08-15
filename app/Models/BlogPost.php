<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'seo',
        'is_published',
        'published_at',
        'author_id',
        'category_id',
    ];

    /**
     * Casts & Dates
     */
    protected $casts = [
        'seo'          => 'array',
        'is_published' => 'bool',
        'published_at' => 'datetime',
    ];

    protected $dates = [
        'published_at',
    ];

    protected $appends = [
        'excerpt',
        'reading_time',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    protected static function booted(): void
    {
        static::creating(function (self $post) {
            if (empty($post->slug) && !empty($post->title)) {
                $post->slug = static::uniqueSlugFromTitle($post->title);
            }
            if ($post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function (self $post) {
            if ($post->isDirty('title') && !$post->isDirty('slug')) {
                $post->slug = static::uniqueSlugFromTitle($post->title, $post->id);
            }
            if ($post->isDirty('is_published')) {
                if ($post->is_published && empty($post->published_at)) {
                    $post->published_at = now();
                }
            }
        });
    }

    protected static function uniqueSlugFromTitle(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    protected function excerpt(): Attribute
    {
        return Attribute::get(function () {
            $text = strip_tags((string) $this->body);
            return Str::words($text, 30);
        });
    }

    protected function readingTime(): Attribute
    {
        return Attribute::get(function () {
            $words = str_word_count(strip_tags((string) $this->body));
            return max(1, (int) ceil($words / 200));
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('is_published', false)
              ->orWhereNull('published_at')
              ->orWhere('published_at', '>', now());
        });
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at')->orderByDesc('created_at');
    }

    public function scopeInCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeTagged(Builder $query, $tagIds): Builder
    {
        $tagIds = is_array($tagIds) ? $tagIds : [$tagIds];
        return $query->whereHas('tags', fn ($q) => $q->whereIn('tags.id', $tagIds));
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term) return $query;
        $termLike = '%' . str_replace('%', '\\%', $term) . '%';

        return $query->where(function ($q) use ($termLike) {
            $q->where('title', 'like', $termLike)
              ->orWhere('slug', 'like', $termLike)
              ->orWhere('body', 'like', $termLike)
              ->orWhereJsonContains('seo->meta_title', $termLike)
              ->orWhereJsonContains('seo->meta_description', $termLike);
        });
    }

    public function publish(?\DateTimeInterface $at = null): self
    {
        $this->is_published = true;
        $this->published_at = $at ?: now();
        $this->save();
        return $this;
    }

    public function unpublish(): self
    {
        $this->is_published = false;
        $this->save();
        return $this;
    }
}
