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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unit_id');  // Make sure this line exists
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->unsignedBigInteger('equipment_type_id')->nullable();

            $table->string('building_number');
            $table->string('office_name');
            $table->enum('priority_level', ['High', 'Mid', 'Low'])->nullable();
            $table->string('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Open','In Progress', 'Closed'])->default('Open');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->foreign('equipment_type_id')->references('id')->on('problem_types');
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
