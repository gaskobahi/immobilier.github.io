<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VilleUpdateLongitudelatitude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villes', function (Blueprint $table) {
           // $table->double('longitude');
           // $table->double('latitude');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villes', function (Blueprint $table) {
            //
        });
    }
}
