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
        Schema::create('child', function (Blueprint $table) {
            $table->id();
            $table->string('mothers_name');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->tinyText('gender', ['M', 'F'])->comment('m=male,f=female');
            $table->date('birthdate');
            $table->float('weight', 8, 2);
            $table->integer('height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child');
    }
};
