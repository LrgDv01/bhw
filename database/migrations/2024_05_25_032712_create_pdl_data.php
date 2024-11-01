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
        Schema::create('pdl_data', function (Blueprint $table) {
            $table->id();
            $table->string('pdl_id')->nullable();
            $table->string('facility_id')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->string('remark')->nullable();
            $table->string('birthday')->nullable();
            $table->string('crimeCategory')->nullable();
            $table->string('specify_case')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdl_data');
    }
};
