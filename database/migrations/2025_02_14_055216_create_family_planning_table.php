<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('family_planning', function (Blueprint $table) {
            $table->id();
            $table->string('family_serial_no');
            $table->string('name');
            $table->string('address');
            $table->date('age_dob');
            $table->string('se_status');
            $table->string('client_type');
            $table->string('source');
            $table->string('previous_method');
            $table->string('month');
            $table->date('schedule_date');
            $table->date('actual_date')->nullable();
            $table->date('dropout_date')->nullable();
            $table->string('dropout_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_planning');
    }
};
