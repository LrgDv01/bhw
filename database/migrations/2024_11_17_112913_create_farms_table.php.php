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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('location');
            $table->string('variety'); // For coconut variety (e.g., Tall, Dwarf, Hybrid)
            $table->decimal('hectares', 8, 2); // For farm area in hectares, with 2 decimal places
            $table->integer('tree_age'); // For age of trees in years
            $table->integer('planted_coconut'); // For number of planted coconut trees
            $table->string('soil_type'); // For soil type (e.g., Sandy, Clay, Loam, Silty)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('farms');
    }
};
