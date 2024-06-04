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
            $table->unsignedBigInteger('user_id')->nullable(); // requesitor
            
            $table->unsignedBigInteger('building_number_id')->nullable();
            $table->unsignedBigInteger('office_name_id')->nullable();
            $table->enum('priority_level', ['High', 'Mid', 'Low'])->nullable();
            $table->string('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Open', 'In Progress', 'Purchase Parts', 'Closed', 'Completed'])->default('Open')->nullable();
            $table->string('reason')->nullable();
            $table->string('purchase_parts')->nullable();
            $table->unsignedBigInteger('serial_number')->nullable();
            $table->boolean('covered_under_warranty')->default(false);
            $table->enum('initial_assessment', ['On-Site', 'Shipped at Office'])->nullable();
            $table->string('action_performed')->nullable();

            $table->unsignedBigInteger('ictram_id')->nullable();
            $table->unsignedBigInteger('nicmu_id')->nullable();
            $table->unsignedBigInteger('mis_id')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ictram_id')->references('id')->on('ictram')->onDelete('cascade');
            $table->foreign('nicmu_id')->references('id')->on('nicmu')->onDelete('cascade');
            $table->foreign('mis_id')->references('id')->on('mis')->onDelete('cascade');
            $table->foreign('building_number_id')->references('id')->on('building_numbers')->onDelete('cascade');
            $table->foreign('office_name_id')->references('id')->on('office_names')->onDelete('cascade');
            
             
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