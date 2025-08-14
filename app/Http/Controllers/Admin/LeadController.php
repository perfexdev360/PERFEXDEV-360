<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeadRequest;
use App\Models\Lead;
use App\Models\LeadStageChange;
use Illuminate\Http\Request;
use App\Repositories\LeadRepository;

class LeadController extends Controller
{
    public function __construct(protected LeadRepository $repository)
    {
        $this->authorizeResource(Lead::class, 'lead');
    }

    public function index()
    {
        return response()->json($this->repository->all());
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(LeadRequest $request)
    {
        $lead = $this->repository->create($request->validated());
        return response()->json($lead, 201);
    }

    public function show(Lead $lead)
    {
        return response()->json($this->repository->find($lead));
    }

    public function edit(Lead $lead)
    {
        return response()->json($this->repository->find($lead));
    }

    public function update(LeadRequest $request, Lead $lead)
    {
        $lead = $this->repository->update($lead, $request->validated());
        return response()->json($lead);
    }

    public function destroy(Lead $lead)
    {
        $this->repository->delete($lead);
        return response()->json(null, 204);
    }

    /**
     * Update the pipeline stage for the given lead.
     */
    public function moveStage(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'stage_id' => ['required', 'integer', 'exists:pipeline_stages,id'],
        ]);

        $from = $lead->pipeline_stage_id;
        $to = $data['stage_id'];

        if ($from === $to) {
            return response()->noContent();
        }

        $lead->pipeline_stage_id = $to;
        $lead->save();

        $change = new LeadStageChange();
        $change->lead_id = $lead->id;
        $change->from_stage_id = $from;
        $change->to_stage_id = $to;
        $change->changed_by = optional($request->user())->id;
        $change->save();

        return response()->json(['status' => 'ok']);
    }
}
