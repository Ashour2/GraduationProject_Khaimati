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
        Schema::create('change_log_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('change_logs_id')->constrained('change_logs')->cascadeOnDelete();
            $table->string('field_name', 100);
            $table->string('old_value', 255)->nullable();
            $table->string('new_value', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_log_details');
    }
};
