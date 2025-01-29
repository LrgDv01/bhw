<?php

// database/migrations/xxxx_xx_xx_create_family_members_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->string('house_no');
            $table->string('full_name');
            $table->string('role');
            $table->date('dob');
            $table->string('age');
            $table->string('is_4ps');
            $table->string('is_senior_citizen');
            $table->string('is_pregnant');
            $table->integer('pregnancy_months')->nullable();
            $table->string('birth_plan');
            $table->string('civil_status');
            $table->date('next_visit');
            $table->string('family_planning_method');
            $table->string('is_registered_voter');
            $table->string('own_toilet');
            $table->string('clean_water');
            $table->string('hypertension');
            $table->date('next_visit_clinic')->nullable();
            $table->string('has_tb_symptoms');
            $table->string('sputum_test');
            $table->string('sputum_result')->nullable();
            $table->string('treatment_partner');
            $table->date('next_checkup')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_members');
    }
}

