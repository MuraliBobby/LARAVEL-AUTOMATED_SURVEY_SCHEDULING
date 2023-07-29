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
        Schema::create('time_frequnecies', function (Blueprint $table) {
            $table->id('user_id');
            $table->time('frequent_login_time');
            $table->time('frequent_logout_time');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_frequnecies');
    }
};
