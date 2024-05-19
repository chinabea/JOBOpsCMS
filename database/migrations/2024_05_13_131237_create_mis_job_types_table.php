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
        Schema::create('mis_job_types', function (Blueprint $table) {
            $table->id();
            $table->string('jobType_name');
            // $table->unsignedBigInteger('mis_request_type_id');
            // $table->unsignedBigInteger('asname_id'); // Modify this line
            $table->timestamps();

            // $table->foreign('mis_request_type_id')->references('id')->on('mis_request_types')->onDelete('cascade');
            // $table->foreign('asname_id')->references('id')->on('mis_asnames')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_job_types');
    }
};
