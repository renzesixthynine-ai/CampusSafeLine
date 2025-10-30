<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_reports', function (Blueprint $table) {
            $table->id();
            $table->string('case_id')->unique(); // Public case ID for tracking
            $table->string('pin_hash'); // Hashed PIN for case access
            $table->string('category');
            $table->text('description');
            $table->string('location')->nullable();
            $table->timestamp('incident_date')->nullable();
            $table->foreignId('reporter_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_officer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new');
            $table->text('internal_notes')->nullable(); // Officer/Admin only notes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_reports');
    }
};
