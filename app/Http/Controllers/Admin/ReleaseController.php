<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReleaseRequest;
use App\Models\Release;
use App\Repositories\ReleaseRepository;

class ReleaseController extends Controller
{
    public function __construct(protected ReleaseRepository $repository)
    {
        $this->authorizeResource(Release::class, 'release');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(ReleaseRequest $request)
    {
        $release = $this->repository->create($request->validated());
        return response()->json($release, 201);
    }

    public function show(Release $release)
    {
        return response()->json($this->repository->find($release));
    }

    public function edit(Release $release)
    {
        return response()->json($this->repository->find($release));
    }

    public function update(ReleaseRequest $request, Release $release)
    {
        $release = $this->repository->update($release, $request->validated());
        return response()->json($release);
    }

    public function destroy(Release $release)
    {
        $this->repository->delete($release);
        return response()->json(null, 204);
    }
}
