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
        Schema::create('aid_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aid_distributions_id')->constrained('aid_distributions')->cascadeOnDelete();
            $table->foreignId('family_members_id')->nullable()->constrained('family_members')->nullOnDelete();
            $table->foreignId('families_id')->nullable()->constrained('families')->nullOnDelete();
            $table->unsignedBigInteger('family_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aid_beneficiaries');
    }
};
