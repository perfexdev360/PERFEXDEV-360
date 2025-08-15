<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
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
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'subject' => $this->faker->sentence(),
            'category' => $this->faker->word(),
            'priority' => $this->faker->randomElement(['low','normal','high','urgent']),
            'status' => $this->faker->randomElement(['open','pending','resolved','closed']),
            'project_id' => Project::factory(),
            'last_activity_at' => now(),
        ];
    }
}
