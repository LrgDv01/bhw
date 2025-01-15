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
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farm_id'); // Define the column
            // $table->foreignId('farm_id')->constrained('reports')->references('farm_id')->onDelete('cascade');
            $table->integer('yellowing');
            $table->integer('bud_rot');
            $table->integer('leaf_spot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};
