<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostRequest;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;

class BlogPostController extends Controller
{
    public function __construct(protected BlogPostRepository $repository)
    {
        $this->authorizeResource(BlogPost::class, 'blogPost');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(BlogPostRequest $request)
    {
        $blogPost = $this->repository->create($request->validated());
        return response()->json($blogPost, 201);
    }

    public function show(BlogPost $blogPost)
    {
        return response()->json($this->repository->find($blogPost));
    }

    public function edit(BlogPost $blogPost)
    {
        return response()->json($this->repository->find($blogPost));
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost = $this->repository->update($blogPost, $request->validated());
        return response()->json($blogPost);
    }

    public function destroy(BlogPost $blogPost)
    {
        $this->repository->delete($blogPost);
        return response()->json(null, 204);
    }
}
