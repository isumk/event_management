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
        Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
        $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
        $table->string('description');
        $table->string('status')->default('pending'); // pending, in_progress, completed
        $table->date('start_date')->nullable();
        $table->date('due_date')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
