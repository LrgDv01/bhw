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
        Schema::create('excluded_booking', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('pdlID');
            $table->string('transaction_number');
            $table->string('type');
            $table->date('start_event');
            $table->string('remark');
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excluded_booking');
    }
};
