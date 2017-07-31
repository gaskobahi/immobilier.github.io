<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddforeignkeyvilleProprietaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proprietaires', function (Blueprint $table) {
            $table->integer('ville_id')->unsigned();
            $table->foreign('ville_id')->references('id')->on('villes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proprietaires', function (Blueprint $table) {
            //
        });
    }
}
