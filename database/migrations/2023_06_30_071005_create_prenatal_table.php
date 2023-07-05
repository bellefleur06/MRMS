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
        Schema::create('prenatal', function (Blueprint $table) {
            $table->id();
            $table->string('patient_code')->unique();
            $table->string('patient_name');
            $table->string('prenatal_schedule');
            $table->string('nurse_midwife');
            $table->string('blood_pressure');
            $table->float('weight', 8, 2);
            $table->integer('tummy_size');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenatal');
    }
};
