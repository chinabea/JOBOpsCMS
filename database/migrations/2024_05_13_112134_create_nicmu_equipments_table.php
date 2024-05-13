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
        Schema::create('nicmu_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('nicmu_job_type_id');
    
            $table->foreign('nicmu_job_type_id')->references('id')->on('nicmu_job_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nicmu_equipments');
    }
};
