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
        Schema::create('registration_requests', function (Blueprint $table) {
            $table->id();
            $table->string('camp_name', 150);
            $table->string('governorate', 100);
            $table->string('location', 150);
            $table->integer('families_count')->default(0);
            $table->string('rep_name', 100);
            $table->string('gender', 20)->nullable();
            $table->string('national_id_no', 20);
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->string('national_id_img_path', 255)->nullable();
            $table->string('personal_img_path', 255)->nullable();
            $table->string('verification_img_path', 255)->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_requests');
    }
};
