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
        Schema::create('maternal_cares', function (Blueprint $table) {
            $table->id(); 
            $table->integer('serial_no');
            $table->string('full_name'); 
            $table->string('address'); 
            $table->string('se_status'); 
            $table->integer('age'); 
            $table->date('lmp'); 
            $table->date('edc'); 
            $table->date('first_tri'); 
            $table->date('second_tri');
            $table->date('third_tri');
            $table->date('td1');
            $table->date('td2');
            $table->date('td3');
            $table->date('td4');
            $table->date('td5');
            $table->date('iron_visit1');
            $table->date('iron_tablets_1');
            $table->date('iron_visit2');
            $table->date('iron_tablets_2');
            $table->date('iron_visit3');
            $table->date('iron_tablets_3');
            $table->date('iron_visit4');
            $table->date('iron_tablets_4');
            $table->date('cal_visit2');
            $table->date('cal_tablets_2');
            $table->date('cal_visit3');
            $table->date('cal_tablets_3');
            $table->date('cal_visit4');
            $table->date('cal_tablets_4');
            $table->date('iodine_visit1');
            $table->string('bmi');
            $table->date('deworming_tablet');
            $table->date('syph');
            $table->date('hepa');
            $table->date('hiv');
            $table->date('rpr_or_rdt');
            $table->date('hbsag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maternal_cares');
    }
};
