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
        Schema::table('preference', function (Blueprint $table) {
            //
            // Add the 'id' column as an auto-incrementing primary key
            $table->id();

            // If you want to keep the existing 'user_id' column, make sure it's unique
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preference', function (Blueprint $table) {
            //
            $table->dropUnique('user_id');
            $table->dropColumn('id');
        });
    }
};
