<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dewormings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dewormings');
    }
};
