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
        Schema::create('academic_sessions', function (Blueprint $table) {
            $table->id();
             $table->string('name')->unique(); // e.g., 2025-2026
             $table->boolean('is_active')->default(false); // only one active session
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_sessions');
    }
};
