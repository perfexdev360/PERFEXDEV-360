<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadStageChange;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
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
