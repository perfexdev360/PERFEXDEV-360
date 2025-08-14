<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LicenseRequest;
use App\Models\License;
use App\Repositories\LicenseRepository;

class LicenseController extends Controller
{
    public function __construct(protected LicenseRepository $repository)
    {
        $this->authorizeResource(License::class, 'license');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(LicenseRequest $request)
    {
        $license = $this->repository->create($request->validated());
        return response()->json($license, 201);
    }

    public function show(License $license)
    {
        return response()->json($this->repository->find($license));
    }

    public function edit(License $license)
    {
        return response()->json($this->repository->find($license));
    }

    public function update(LicenseRequest $request, License $license)
    {
        $license = $this->repository->update($license, $request->validated());
        return response()->json($license);
    }

    public function destroy(License $license)
    {
        $this->repository->delete($license);
        return response()->json(null, 204);
    }
}
