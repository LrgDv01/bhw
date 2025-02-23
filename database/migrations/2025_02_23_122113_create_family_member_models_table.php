<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('relation_to_hfam');
            $table->date('birthday');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('sex');
            $table->string('edu_attainment');
            $table->string('religion');
            $table->string('fam_planning');
            $table->string('phihealth_no');
            $table->string('membership_type');
            $table->enum('voters', ['Yes', 'No']);
            $table->string('medical_history');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};