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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id(); // This sets 'id' as the auto-incrementing primary key
            $table->unsignedBigInteger('user_id');
            $table->string('preferences');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();

            // Add foreign key constraint to link with the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Add a composite unique index to ensure user preferences are unique per user
            $table->unique(['user_id', 'preferences']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
