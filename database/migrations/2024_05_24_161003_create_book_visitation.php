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
        Schema::create('book_visitation', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->string('pdl_id');
            $table->dateTime('start_visit');
            $table->dateTime('end_visit');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('type');
            $table->string('valid_id');
            $table->string('verification_docs');
            $table->string('status');
            $table->string('link_type')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_visitation');
    }
};
