<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('representatives', function (Blueprint $table) {
            if (Schema::hasIndex('representatives', 'representatives_camp_id_unique')) {
                $table->dropUnique(['camp_id']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('representatives', function (Blueprint $table) {
            $table->unique('camp_id');
        });
    }
};
