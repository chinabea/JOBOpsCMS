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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('google_id')->nullable()->unique(); // To store Google's user ID
            $table->string('name');
            $table->integer('role')->nullable();
            $table->string('job_position')->nullable();
            $table->string('email')->unique();
            $table->string('avatar', 1512)->nullable();
            $table->string('phone_number', 11)->nullable();
            $table->string('expertise')->nullable();
            $table->boolean('is_approved')->default(false); 
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        // Schema::dropIfExists('password_reset_tokens');
        // Schema::dropIfExists('sessions');
    }
};
