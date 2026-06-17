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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('families_id')->constrained('families')->cascadeOnDelete();
            $table->string('relation_to_guardian', 50)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('name', 100);
            $table->string('national_id_no', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->string('maritral_status', 30)->nullable();
            $table->boolean('is_injured')->default(false);
            $table->boolean('have_physical_diability')->default(false);
            $table->boolean('need_diapers')->default(false);
            $table->string('medical_eq_needed', 255)->nullable();
            $table->boolean('is_lacting')->default(false);
            $table->boolean('is_pregnent')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
