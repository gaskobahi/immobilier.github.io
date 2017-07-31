<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitreproprieteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titreproprietes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('piece');
            $table->integer('proprietaire_id')->unsigned();
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires');
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
        Schema::dropIfExists('titreproprietes');
    }
}
