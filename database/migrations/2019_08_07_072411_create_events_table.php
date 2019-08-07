<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('eventname');
            $table->date('datefrom');
            $table->date('dateto');
            $table->integer('sun');
            $table->integer('mon');
            $table->integer('tue');
            $table->integer('wed');
            $table->integer('thu');
            $table->integer('fri');
            $table->integer('sat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
