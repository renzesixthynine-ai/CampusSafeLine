<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CaseReport;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@campussafeline.edu',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create test officers
        $officers = User::factory()->count(5)->create([
            'role' => 'officer',
            'is_active' => true,
        ]);

        // Create test cases
        $cases = CaseReport::factory()
            ->count(20)
            ->sequence(fn ($sequence) => [
                'status' => ['new', 'in_progress', 'resolved', 'closed'][rand(0, 3)],
                'assigned_officer_id' => $sequence->index % 2 === 0 ? $officers->random()->id : null,
            ])
            ->create();

        // Create messages for each case
        foreach ($cases as $case) {
            // Reporter messages
            Message::factory()
                ->count(rand(1, 5))
                ->create([
                    'case_report_id' => $case->id,
                    'sender_id' => null,
                    'is_internal' => false,
                ]);

            // Officer messages
            if ($case->assigned_officer_id) {
                Message::factory()
                    ->count(rand(1, 3))
                    ->create([
                        'case_report_id' => $case->id,
                        'sender_id' => $case->assigned_officer_id,
                        'is_internal' => false,
                    ]);

                // Internal notes
                Message::factory()
                    ->count(rand(1, 2))
                    ->create([
                        'case_report_id' => $case->id,
                        'sender_id' => $case->assigned_officer_id,
                        'is_internal' => true,
                    ]);
            }
        }
    }
}
