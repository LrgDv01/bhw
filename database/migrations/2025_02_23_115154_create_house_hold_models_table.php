<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('house_no')->nullable();
            $table->string('head_of_fam')->nullable();
            $table->enum('toilet_facility', ['Yes', 'No'])->nullable();
            $table->enum('water_source', ['Yes', 'No'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};