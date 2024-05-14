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
        Schema::create('ictram_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name');
            // $table->string('problemOrIssue');
            $table->unsignedBigInteger('ictram_job_type_id');
            $table->timestamps();

            $table->foreign('ictram_job_type_id')->references('id')->on('ictram_job_types')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ictram_equipments');
    }
};
