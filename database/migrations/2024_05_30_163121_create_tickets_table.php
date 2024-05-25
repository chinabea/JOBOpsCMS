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

            $table->string('building_number')->nullable();
            $table->string('office_name')->nullable();
            $table->enum('priority_level', ['High', 'Mid', 'Low'])->nullable();
            $table->string('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Open','In Progress','Closed', 'Completed'])->default('Open')->nullable();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('serial_number')->nullable();
            $table->boolean('covered_under_warranty')->default(false);
            
            $table->unsignedBigInteger('ictram_id')->nullable();
            // $table->unsignedBigInteger('ictram_equipment_id')->nullable();
            // $table->unsignedBigInteger('ictram_problem_id')->nullable();

            $table->unsignedBigInteger('nicmu_id')->nullable();
            // $table->unsignedBigInteger('nicmu_equipment_id')->nullable();
            // $table->unsignedBigInteger('nicmu_problem_id')->nullable();
            
            $table->unsignedBigInteger('mis_id')->nullable();
            // $table->unsignedBigInteger('mis_job_type_id')->nullable();
            // $table->unsignedBigInteger('mis_asname_id')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('ictram_id')->references('id')->on('ictram')->onDelete('cascade');
            // $table->foreign('ictram_problem_id')->references('id')->on('ictram')->onDelete('cascade');
            // $table->foreign('ictram_equipment_id')->references('id')->on('ictram')->onDelete('cascade');

            $table->foreign('nicmu_id')->references('id')->on('nicmu')->onDelete('cascade');
            // $table->foreign('nicmu_equipment_id')->references('id')->on('nicmu')->onDelete('cascade');
            // $table->foreign('nicmu_problem_id')->references('id')->on('nicmu')->onDelete('cascade');

            $table->foreign('mis_id')->references('id')->on('mis')->onDelete('cascade');
            // $table->foreign('mis_job_type_id')->references('id')->on('mis')->onDelete('cascade');
            // $table->foreign('mis_asname_id')->references('id')->on('mis')->onDelete('cascade');
            
             
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