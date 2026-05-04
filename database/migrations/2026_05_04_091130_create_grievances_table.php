<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grievances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            
            // Routing & Assignment
            $table->string('category'); // e.g., Academic, Hostel, Finance
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_emergency')->default(false);
            
            // The Content
            $table->string('subject');
            $table->text('description');
            $table->string('attachment_path')->nullable(); // For file uploads
            
            // Status tracking
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grievances');
    }
};
