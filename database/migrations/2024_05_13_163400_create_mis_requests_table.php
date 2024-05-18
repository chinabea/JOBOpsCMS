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
        Schema::create('mis_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mis_request_type_id');
            $table->unsignedBigInteger('mis_job_type_id');
            $table->unsignedBigInteger('mis_asname_id');
            $table->timestamps();

            $table->foreign('mis_request_type_id')->references('id')->on('mis_request_types')->onDelete('cascade');
            $table->foreign('mis_job_type_id')->references('id')->on('mis_job_types')->onDelete('cascade');
            $table->foreign('mis_asname_id')->references('id')->on('mis_asnames')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_requests');
    }
};
