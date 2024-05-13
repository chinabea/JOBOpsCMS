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
        Schema::create('ictram_problems', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('ictram_equipment_id');
            $table->timestamps();

            $table->foreign('ictram_equipment_id')->references('id')->on('ictram_equipments')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ictram_problems');
    }
};
