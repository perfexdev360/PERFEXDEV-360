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
        $data = $request->validated();
        $data['user_id'] = $data['user_id'] ?? $request->user()->id;

        $project = $this->repository->create($data);

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
        $data = $request->validated();
        $data['user_id'] = $data['user_id'] ?? $project->user_id;

        $project = $this->repository->update($project, $data);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $this->repository->delete($project);
        return response()->json(null, 204);
    }
}
