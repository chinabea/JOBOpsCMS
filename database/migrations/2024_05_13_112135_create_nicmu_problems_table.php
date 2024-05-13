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
        Schema::create('nicmu_problems', function (Blueprint $table) {
            $table->id();
            $table->string('problem_description');
            $table->unsignedBigInteger('nicmu_equipment_id');

            $table->foreign('nicmu_equipment_id')->references('id')->on('nicmu_equipments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nicmu_problems');
    }
};
