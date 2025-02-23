<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotherCensusTable extends Migration
{
    public function up()
    {
        Schema::create('mother_census', function (Blueprint $table) {
            $table->id(); 
            $table->integer('house_no');
            $table->string('first_name'); 
            $table->string('middle_name')->nullable(); 
            $table->string('last_name'); 
            $table->string('role_in_family'); 
            $table->integer('age'); 
            $table->date('date_of_birth'); 
            $table->enum('senior_citizen', ['Yes', 'No']);
            $table->date('next_midwife_visit')->nullable();
            $table->date('next_clinic_visit')->nullable();
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced', 'Separated']);
            $table->enum('registered_voter', ['Yes', 'No']);
            $table->enum('four_ps_member', ['Yes', 'No']); 
            $table->integer('months_pregnant')->nullable();
            $table->date('next_checkup')->nullable(); 
            $table->string('family_planning')->nullable(); 
            $table->enum('own_toilet', ['Yes', 'No']); 
            $table->string('birth_plan')->nullable(); 
            $table->enum('clean_water_source', ['Yes', 'No']); 
            $table->enum('hypertension_experience', ['Yes', 'No']);
            $table->enum('pregnant', ['Yes', 'No']);
            $table->enum('tb_symptoms', ['Yes', 'No']); 
            $table->enum('sputum_test', ['Yes', 'No']);
            $table->enum('sputum_result', ['Negative', 'Positive'])->nullable(); 
            $table->enum('tb_treatment_partner', ['Yes', 'No']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mother_census');
    }
}
