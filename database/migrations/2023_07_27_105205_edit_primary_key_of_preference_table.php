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
        //
        Schema::table('preferences', function (Blueprint $table) {
            
            // Add a composite unique index using user_id and category columns
            $table->unique(['user_id', 'preferences']);

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preferences', function (Blueprint $table) {
            // Drop the composite unique index if you ever need to rollback
            $table->dropUnique(['user_id', 'preferences']);

        });

    }
};
