<?php

namespace Database\Seeders;

use App\Models\{BlogPost, Invoice, Lead, License, Order, Page, PipelineStage, Product, Project, Quote, ReleaseChannel, Ticket, User, Version, Setting};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(9)->create();
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'ADMIN',
        ]);
        $users->push($admin);

        Setting::firstOrCreate([
            'key' => 'google_meet_template',
        ], [
            'value' => 'https://meet.google.com/{code}',
        ]);

        Page::factory(5)->create();
        BlogPost::factory(5)->for($users->random(), 'author')->create();

        $channels = ReleaseChannel::factory()->count(3)->create();

        Product::factory()
            ->count(5)
            ->has(Version::factory()->count(3)->state(fn () => ['release_channel_id' => $channels->random()->id]))
            ->has(License::factory()->count(2)->for($users->random()))
            ->create();

        $stages = PipelineStage::factory()->count(4)->create();

        Lead::factory()
            ->count(10)
            ->for($stages->random(), 'pipelineStage')
            ->for($users->random(), 'assignedTo')
            ->has(Quote::factory()->count(1)->for($users->random()))
            ->create();

        Order::factory()
            ->count(5)
            ->for($users->random())
            ->has(Invoice::factory())
            ->create();

        Project::factory()
            ->count(3)
            ->for($users->random())
            ->has(Ticket::factory()->count(2)->for($users->random()))
            ->create();
    }
}
