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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')->constrained('camps')->cascadeOnDelete();
            $table->string('guardian_name', 100);
            $table->string('gender', 20)->nullable();
            $table->string('national_id_no', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->string('marital_status', 30)->nullable();
            $table->string('governorate', 100)->nullable();
            $table->string('place_of_residence', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('alt_phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->boolean('is_injured')->default(false);
            $table->boolean('have_physical_disbility')->default(false);
            $table->boolean('need_diapers')->default(false);
            $table->string('medical_eq_needed', 255)->nullable();
            $table->boolean('is_lacting')->default(false);
            $table->boolean('is_pregnant')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
