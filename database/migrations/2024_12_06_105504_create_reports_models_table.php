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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('farmer_name'); // Farmer's name
            $table->string('contact_no'); // Contact number
            $table->string('recipient'); // Recipient's name
            $table->string('farm_location'); // Farm location
            $table->decimal('farm_size', 10, 2); // Farm size in hectares, with more precision (optional change)
            $table->bigInteger('coconut_trees'); // Number of coconut trees, use bigInteger for large numbers
            $table->string('coconut_variety'); // Variety of coconuts
            $table->string('soil_type'); // Type of diseases, optional
            $table->json('disease_type'); // Type of diseases, optional
            $table->text('note'); // Note or description of the report (use text for longer input)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
