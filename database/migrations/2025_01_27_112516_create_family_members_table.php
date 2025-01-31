<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->integer('house_no');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('role_in_family');
            $table->integer('age');
            $table->date('date_of_birth');
            $table->enum('senior_citizen', ['YES', 'NO']);
            $table->date('next_midwife_visit')->nullable();
            $table->date('next_clinic_visit')->nullable();
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced', 'Separated']);
            $table->enum('registered_voter', ['YES', 'NO']);
            $table->enum('four_ps_member', ['YES', 'NO']);
            $table->integer('months_pregnant')->nullable();
            $table->date('next_checkup')->nullable();

            $table->enum('family_planning', ['YES', 'NO']);
            $table->enum('own_toilet', ['YES', 'NO']);
            $table->enum('birth_plan', ['YES', 'NO']);
            $table->enum('clean_water_source', ['YES', 'NO']);
            $table->enum('hypertension_experience', ['YES', 'NO']);
            $table->enum('pregnant', ['YES', 'NO']);
            $table->enum('tb_symptoms', ['YES', 'NO']);
            $table->enum('sputum_test', ['YES', 'NO']);
            $table->enum('sputum_result', ['Negative', 'Positive'])->nullable();
            $table->enum('tb_treatment_partner', ['YES', 'NO']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_members');
    }
}
