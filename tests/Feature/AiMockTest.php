<?php

use App\Services\AI\GeminiWriter;
use App\Services\AI\SuggestedReplyService;
use App\Jobs\GenerateBlogPost;
use App\Models\{BlogPost, User};
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('drafts blog posts with internal links via mocked gemini', function () {
    config()->set('features.ai_content_engine', true);
    Gemini::shouldReceive('generateContent')->andReturn(new class {
        public function text() {
            return json_encode([
                'title' => 'Title',
                'meta_title' => 'Meta',
                'meta_description' => 'Desc',
                'body' => '<p>Body</p>',
                'json_ld' => [],
            ]);
        }
    });

    $writer = new GeminiWriter();
    $result = $writer->draft('topic', ['https://a.test','https://b.test','https://c.test']);

    expect(substr_count($result['body'], 'https://'))->toBeGreaterThanOrEqual(3);
});

it('suggests replies using mocked gemini', function () {
    config()->set('features.ai_content_engine', true);
    Gemini::shouldReceive('generateContent')->andReturn(new class {
        public function text() { return 'Thanks!'; }
    });

    $service = new SuggestedReplyService();
    $reply = $service->suggest('How to install?');

    expect($reply)->toBe('Thanks!');
});

it('regenerates sitemap when approving ai draft', function () {
    config()->set('features.ai_content_engine', true);
    Artisan::shouldReceive('call')->once()->with('sitemap:generate');
    File::shouldReceive('put')->once();
    Cache::shouldReceive('flush')->once();

    $post = BlogPost::factory()->create(['is_published' => false]);

    actingAs(User::factory()->create(['role' => 'admin']));
    post(route('ai-queue.approve', $post))->assertRedirect();

    expect($post->fresh()->is_published)->toBeTrue();
});

it('plans content by scanning sitemap', function () {
    config()->set('features.ai_content_engine', true);
    Http::fake(['*' => Http::response('<urlset><url><loc>'.url('/a').'</loc></url></urlset>')]);
    Queue::fake();

    app(App\Services\AI\ContentPlanner::class)->plan();

    Queue::assertPushed(GenerateBlogPost::class);
});
