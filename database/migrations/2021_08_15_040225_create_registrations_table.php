<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('dob');
            $table->string('id_no');
            $table->string('phone_no');
            $table->unsignedBigInteger('center_id');
            $table->dateTime('upcoming_date');
            $table->dateTime('v1_date');
            $table->dateTime('v2_date');
            $table->string('unique_id');
            $table->unsignedBigInteger('diabates');
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('vaccination_centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
