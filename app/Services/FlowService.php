<?php

namespace App\Services;

use App\Models\{Invoice, Lead, LeadStageChange, License, LicenseActivation, Order, PipelineStage, Product, Quote, ServiceRequest, Ticket, TicketReply, User, Release};
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * High level orchestration for common business flows.
 *
 * These methods provide simple implementations for the flows described in the
 * project's roadmap: purchasing with license activation, lead management,
 * quote conversion, service request RFQs, ticket replies, and role enforcement.
 * They intentionally contain only minimal logic so they can be adapted to more
 * specific business rules.
 */
class FlowService
{
    /**
     * Create a new sales lead.
     */
    public function createLead(array $data): Lead
    {
        return Lead::create($data);
    }

    /**
     * Handle a product purchase and issue a license to the user.
     */
    public function purchaseProduct(User $user, Product $product): License
    {
        return DB::transaction(function () use ($user, $product) {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'paid',
                'total' => $product->price ?? 0,
            ]);

            return License::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'user_id' => $user->id,
                'license_key' => Str::uuid()->toString(),
                'type' => 'standard',
                'duration_days' => 365,
                'activation_limit' => 5,
                'update_window_ends_at' => now()->addYear(),
            ]);
        });
    }

    /**
     * Activate a license for a specific device or installation.
     */
    public function activateLicense(License $license, string $deviceName): LicenseActivation
    {
        return $license->activations()->create([
            'device_name' => $deviceName,
            'activated_at' => now(),
        ]);
    }

    /**
     * Return the latest release available for the license's product.
     */
    public function latestRelease(License $license): ?Release
    {
        return Release::where('product_id', $license->product_id)
            ->latest('released_at')
            ->first();
    }

    /**
     * Move a lead to a new pipeline stage and log the change.
     */
    public function moveLeadToStage(Lead $lead, PipelineStage $stage, ?User $actor = null): Lead
    {
        if ($lead->pipeline_stage_id === $stage->id) {
            return $lead;
        }

        $from = $lead->pipeline_stage_id;
        $lead->pipeline_stage_id = $stage->id;
        $lead->save();

        LeadStageChange::create([
            'lead_id' => $lead->id,
            'from_stage_id' => $from,
            'to_stage_id' => $stage->id,
            'changed_by' => $actor?->id,
        ]);

        return $lead;
    }

    /**
     * Convert an accepted quote into an invoice with line items.
     */
    public function convertQuoteToInvoice(Quote $quote): Invoice
    {
        $invoice = Invoice::create([
            'user_id' => $quote->user_id,
            'status' => 'pending',
            'total' => $quote->total,
            'due_at' => now()->addDays(30),
        ]);

        foreach ($quote->items as $item) {
            $invoice->items()->create([
                'description' => $item->description,
                'amount' => $item->amount,
            ]);
        }

        $quote->update(['converted_at' => now()]);

        return $invoice;
    }

    /**
     * Record a payment against an invoice and update its status.
     */
    public function recordPayment(Invoice $invoice, float $amount, string $provider = 'manual'): Payment
    {
        return $invoice->payments()->create([
            'provider' => $provider,
            'amount' => $amount,
            'status' => 'succeeded',
            'paid_at' => now(),
        ]);
    }

    /**
     * Mark a service request as an RFQ to collect vendor pricing.
     */
    public function createRfQ(ServiceRequest $request): ServiceRequest
    {
        $request->status = 'rfq';
        $request->save();

        return $request;
    }

    /**
     * Record a reply to a ticket and reopen it if necessary.
     */
    public function replyToTicket(Ticket $ticket, User $user, string $message): TicketReply
    {
        $reply = $ticket->replies()->create([
            'user_id' => $user->id,
            'message' => $message,
        ]);

        $ticket->status = 'open';
        $ticket->save();

        return $reply;
    }

    /**
     * Close a ticket after resolution.
     */
    public function closeTicket(Ticket $ticket): void
    {
        $ticket->status = 'closed';
        $ticket->closed_at = now();
        $ticket->save();
    }

    /**
     * Check whether the given user is allowed to perform an ability.
     *
     * This is a thin wrapper around Laravel's authorization system and can be
     * expanded with custom logging or policy checks as needed.
     */
    public function authorize(User $user, string $ability): bool
    {
        return $user->can($ability);
    }
}
