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
        Schema::table('students', function (Blueprint $table) {
            // Add columns only if they don't exist
            if (!Schema::hasColumn('students', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable();
            }
            if (!Schema::hasColumn('students', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('students', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('students', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('students', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('students', 'guardian_name')) {
                $table->string('guardian_name')->nullable();
            }
            if (!Schema::hasColumn('students', 'guardian_phone')) {
                $table->string('guardian_phone')->nullable();
            }
            if (!Schema::hasColumn('students', 'guardian_address')) {
                $table->text('guardian_address')->nullable();
            }
            if (!Schema::hasColumn('students', 'guardian_city')) {
                $table->string('guardian_city')->nullable();
            }
            if (!Schema::hasColumn('students', 'guardian_relationship')) {
                $table->string('guardian_relationship')->nullable();
            }

            // Note: Not adding class_id or section_id as they already exist (school_class_id and section_id)
            // Foreign keys for school_class_id and section_id should already be defined in the original migration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop columns only if they exist
            $columns = [
                'gender',
                'phone',
                'email',
                'address',
                'city',
                'guardian_name',
                'guardian_phone',
                'guardian_address',
                'guardian_city',
                'guardian_relationship',
            ];

            $existingColumns = array_filter($columns, fn($column) => Schema::hasColumn('students', $column));
            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};