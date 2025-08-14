<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Repositories\PageRepository;

class PageController extends Controller
{
    public function __construct(protected PageRepository $repository)
    {
        $this->authorizeResource(Page::class, 'page');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(PageRequest $request)
    {
        $page = $this->repository->create($request->validated());
        return response()->json($page, 201);
    }

    public function show(Page $page)
    {
        return response()->json($this->repository->find($page));
    }

    public function edit(Page $page)
    {
        return response()->json($this->repository->find($page));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page = $this->repository->update($page, $request->validated());
        return response()->json($page);
    }

    public function destroy(Page $page)
    {
        $this->repository->delete($page);
        return response()->json(null, 204);
    }
}
