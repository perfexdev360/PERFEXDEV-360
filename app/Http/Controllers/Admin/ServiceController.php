<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;

class ServiceController extends Controller
{
    public function __construct(protected ServiceRepository $repository)
    {
        $this->authorizeResource(Service::class, 'service');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(ServiceRequest $request)
    {
        $service = $this->repository->create($request->validated());
        return response()->json($service, 201);
    }

    public function show(Service $service)
    {
        return response()->json($this->repository->find($service));
    }

    public function edit(Service $service)
    {
        return response()->json($this->repository->find($service));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service = $this->repository->update($service, $request->validated());
        return response()->json($service);
    }

    public function destroy(Service $service)
    {
        $this->repository->delete($service);
        return response()->json(null, 204);
    }
}
