<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bhwregisters', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default('BHW');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('catchment_area');
            $table->string('cover_type');
            $table->integer('accreditation_count')->default(0);
            $table->integer('household_covered');
            $table->date('service_start_date');
            $table->date('accreditation_date');
            $table->string('phone_no')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bhwregisters');
    }
};
