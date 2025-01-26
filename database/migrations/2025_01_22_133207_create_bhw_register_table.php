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
            $table->foreignId('bhw_id')->constrained('users')->onDelete('cascade');
            $table->string('cover_type');
            $table->string('catchment_area');
            $table->integer('accreditation_count')->default(0);
            $table->integer('household_covered');
            $table->date('accreditation_date');
            $table->date('service_start_date');
            $table->date('date_of_registration');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bhwregisters');
    }
};
