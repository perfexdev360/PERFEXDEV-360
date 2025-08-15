<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->latest()->get();

        if ($request->wantsJson()) {
            return response()->json($projects);
        }

        return view('portal.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([]);
        }

        return view('portal.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $project = $request->user()->projects()->create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($project, 201);
        }

        return redirect()->route('projects.show', $project)
            ->with('status', 'Project created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project)
    {
        abort_if($project->user_id !== $request->user()->id, 403);

        if ($request->wantsJson()) {
            return response()->json($project);
        }

        return view('portal.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project)
    {
        abort_if($project->user_id !== $request->user()->id, 403);

        if ($request->wantsJson()) {
            return response()->json($project);
        }

        return view('portal.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        abort_if($project->user_id !== $request->user()->id, 403);

        $project->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($project);
        }

        return redirect()->route('projects.show', $project)
            ->with('status', 'Project updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        abort_if($project->user_id !== $request->user()->id, 403);

        $project->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('projects.index')
            ->with('status', 'Project deleted.');
    }
}
