<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    public function __construct(protected ProjectRepository $repository)
    {
        $this->authorizeResource(Project::class, 'project');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(ProjectRequest $request)
    {
        $project = $this->repository->create($request->validated());
        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return response()->json($this->repository->find($project));
    }

    public function edit(Project $project)
    {
        return response()->json($this->repository->find($project));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project = $this->repository->update($project, $request->validated());
        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $this->repository->delete($project);
        return response()->json(null, 204);
    }
}
