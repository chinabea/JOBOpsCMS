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
        Schema::create('ictram_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ictram_job_type_id');
            $table->unsignedBigInteger('ictram_equipment_id');
            $table->unsignedBigInteger('ictram_problem_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ictram_job_type_id')->references('id')->on('ictram_job_types')->onDelete('cascade');
            $table->foreign('ictram_problem_id')->references('id')->on('ictram_problems')->onDelete('cascade');
            $table->foreign('ictram_equipment_id')->references('id')->on('ictram_equipments')->onDelete('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ictram_requests');
    }
};
