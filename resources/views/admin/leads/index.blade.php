@extends('layouts.admin')

@section('admin-content')
<div class="flex space-x-4 overflow-x-auto" x-data="kanban()">
    @foreach($stages as $stage)
        <div class="w-64 flex-shrink-0" data-stage-id="{{ $stage->id }}">
            <h2 class="font-semibold mb-2">{{ $stage->name }}</h2>
            <div class="space-y-2 min-h-[100px] bg-gray-100 p-2 rounded" x-sortable x-on:sort="reorder($event)">
                @foreach($stage->leads as $lead)
                    <div class="p-2 bg-white rounded shadow" x-sortable-item data-id="{{ $lead->id }}">
                        {{ $lead->name }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<script>
function kanban() {
    return {
        reorder(event) {
            const leadId = event.item.dataset.id;
            const stageId = event.to.closest('[data-stage-id]').getAttribute('data-stage-id');
            fetch(`/admin/leads/${leadId}/move`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ stage_id: stageId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.meeting_url) {
                    console.log('Meeting URL:', data.meeting_url);
                }
            });
        }
    }
}
</script>
@endsection
