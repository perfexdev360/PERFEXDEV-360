<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadStageChange;
use App\Models\PipelineStage;
use Illuminate\Http\Request;
use function Spatie\Activitylog\activity;

class LeadController extends Controller
{
    public function index()
    {
        $stages = PipelineStage::with('leads')->orderBy('order')->get();
        return view('admin.leads.index', compact('stages'));
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

        LeadStageChange::create([
            'lead_id' => $lead->id,
            'from_stage_id' => $from,
            'to_stage_id' => $to,
            'changed_by' => optional($request->user())->id,
        ]);

        activity()
            ->performedOn($lead)
            ->withProperties(['from' => $from, 'to' => $to])
            ->log('lead_stage_changed');

        $stage = PipelineStage::find($to);
        if ($stage && $stage->name === 'Proposal') {
            $meeting = $lead->meetings()->create(['provider' => 'google_meet']);
            return response()->json(['status' => 'ok', 'meeting_url' => $meeting->url]);
        }

        return response()->json(['status' => 'ok']);
    }
}
