<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCensusTable extends Migration
{
    public function up()
    {
        Schema::create('child_censuses', function (Blueprint $table) {
            $table->id();
            $table->string('house_number');
            $table->string('complete_name');
            $table->string('role_in_family');
            $table->date('dob');
            $table->integer('age');
            $table->json('vaccines')->nullable(); // Store vaccines as a JSON array
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_censuses');
    }
}
