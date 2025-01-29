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
        Schema::create('my_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_delivery');
            $table->string('remarks')->nullable();
            $table->time('time_of_visit');
            $table->string('status')->default('Pending'); // Add this line
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_schedules');
    }
};
