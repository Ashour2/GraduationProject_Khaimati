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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')->constrained('camps')->cascadeOnDelete();
            $table->foreignId('supporters_id')->nullable()->constrained('supporters')->nullOnDelete();
            $table->unsignedBigInteger('org_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('package_name', 150);
            $table->string('description', 1000)->nullable();
            $table->integer('recived_q')->default(0);
            $table->integer('distributed_q')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
