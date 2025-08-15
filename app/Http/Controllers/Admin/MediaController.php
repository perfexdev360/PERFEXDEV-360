<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $mediaItems = Media::latest()->paginate();
        return view('admin.media.index', compact('mediaItems'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(MediaRequest $request)
    {
        Media::create($request->validated());
        return redirect()->route('admin.media.index');
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(MediaRequest $request, Media $media)
    {
        $media->update($request->validated());
        return redirect()->route('admin.media.index');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.media.index');
    }
}
