<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bhw_forms', function (Blueprint $table) {
        $table->id();
        $table->integer('followed_up_pregnant_women');
        $table->integer('newborn_babies');
        $table->integer('newborn_screened');
        $table->integer('home_births');
        $table->integer('clinic_births');
        $table->integer('hospital_births');
        $table->integer('sputum_collected');
        $table->integer('followed_up_for_vaccination');
        $table->integer('followed_up_patients');
        $table->integer('followed_up_patient');
        $table->integer('mbhw_meeting_attendance');
        $table->integer('pfbhw_meeting_attendance');
        $table->integer('referred_patients');
        $table->integer('non_referred_patients');
        $table->integer('surveyed_families');
        $table->integer('iodized_salt_sold');
        $table->integer('clean_larvae_habitats');
        $table->integer('total_births_in_area');
        $table->integer('total_deaths_in_area');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhw_forms');
    }
};
