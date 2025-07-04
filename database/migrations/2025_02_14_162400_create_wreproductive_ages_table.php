<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wreproductive_ages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthday');
            $table->integer('age');
            $table->string('status')->nullable();
            $table->string('fp_used');
            $table->string('address');
            $table->string('nhts')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wreproductive_ages');
    }
};
