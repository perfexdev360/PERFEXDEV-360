<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AIQueueController extends Controller
{
    /**
     * Display a listing of AI-generated drafts.
     */
    public function index()
    {
        $posts = BlogPost::where('is_published', false)->get();

        return view('admin.ai-queue.index', compact('posts'));
    }

    /**
     * Approve and publish the given draft.
     */
    public function approve(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->refreshFeeds();

        return redirect()->route('ai-queue.index')->with('status', 'Post published');
    }

    /**
     * Reject the given draft.
     */
    public function reject(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return redirect()->route('ai-queue.index')->with('status', 'Post rejected');
    }

    /**
     * Rebuild RSS feed, regenerate sitemap and clear caches.
     */
    protected function refreshFeeds(): void
    {
        // Regenerate sitemap
        try {
            Artisan::call('sitemap:generate');
        } catch (\Throwable $e) {
            // ignore
        }

        // Generate a very simple RSS feed
        $posts = BlogPost::where('is_published', true)
            ->latest('published_at')
            ->take(20)
            ->get();

        $rss = new \SimpleXMLElement('<?xml version="1.0"?><rss version="2.0"/>');
        $channel = $rss->addChild('channel');
        $channel->addChild('title', config('app.name').' Blog');
        $channel->addChild('link', url('/blog'));
        $channel->addChild('description', 'Latest posts');

        foreach ($posts as $post) {
            $item = $channel->addChild('item');
            $item->addChild('title', htmlspecialchars($post->title));
            $item->addChild('link', url('/blog/'.$post->slug));
            if ($post->published_at) {
                $item->addChild('pubDate', $post->published_at->toRssString());
            }
            $item->addChild('description', htmlspecialchars(Str::limit(strip_tags($post->body), 150)));
        }

        File::put(public_path('rss.xml'), $rss->asXML() ?: '');

        Cache::flush();
    }
}
