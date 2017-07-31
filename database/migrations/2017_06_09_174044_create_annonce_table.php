<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('description');
            $table->string('nombrepiece')->nullable();
            $table->string('superficie')->nullable();
            $table->integer('prix');
            $table->boolean('status');
            $table->boolean('expire');
            $table->integer('user_id')->unsigned();
            $table->string('updatedstatus_by');
            $table->string('updatedexpire_by');
            $table->string('publie_at');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('typeannonce_id')->unsigned();
            $table->foreign('typeannonce_id')->references('id')->on('typeannonces');
            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->integer('ville_id')->unsigned();
            $table->foreign('ville_id')->references('id')->on('villes');
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
        Schema::dropIfExists('annonces');
    }
}
