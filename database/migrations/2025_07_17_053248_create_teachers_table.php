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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
             // Teacher Personal Info
        $table->string('first_name');
        $table->string('last_name');
        $table->enum('gender', ['Male', 'Female', 'Other']);
        $table->date('date_of_birth')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->unique();
        $table->text('address')->nullable();
        $table->string('city')->nullable();

        // Guardian Info
        $table->string('guardian_name')->nullable();
        $table->string('guardian_phone')->nullable();
        $table->text('guardian_address')->nullable();
        $table->string('guardian_city')->nullable();
        $table->string('relation_to_teacher')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
