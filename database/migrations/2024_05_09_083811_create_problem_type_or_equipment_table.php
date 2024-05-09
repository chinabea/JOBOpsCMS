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
        Schema::create('problem_type_or_equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_type_id');
            $table->string('name');
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_type_or_equipment');
    }
};
