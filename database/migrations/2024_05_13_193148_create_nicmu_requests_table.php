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
        Schema::create('nicmu_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('nicmu_job_type_id');
            $table->unsignedBigInteger('nicmu_equipment_id');
            $table->unsignedBigInteger('nicmu_problem_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nicmu_job_type_id')->references('id')->on('nicmu_job_types')->onDelete('cascade');
            $table->foreign('nicmu_equipment_id')->references('id')->on('nicmu_equipments')->onDelete('cascade');
            $table->foreign('nicmu_problem_id')->references('id')->on('nicmu_problems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nicmu_requests');
    }
};
