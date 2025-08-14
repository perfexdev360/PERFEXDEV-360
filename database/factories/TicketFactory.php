<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(),
            'category' => $this->faker->word(),
            'priority' => $this->faker->randomElement(['low','normal','high','urgent']),
            'status' => $this->faker->randomElement(['open','pending','resolved','closed']),
            'last_activity_at' => now(),
        ];
    }
}
