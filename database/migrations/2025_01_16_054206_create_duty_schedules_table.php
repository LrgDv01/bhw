<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('duty_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_bhw');
            $table->string('barangay');
            $table->date('date');
            $table->time('time');
            $table->text('remark')->nullable();
            $table->enum('attendance', ['Present', 'Absent', 'Pending'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duty_schedules');
    }
};
