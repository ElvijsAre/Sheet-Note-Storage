<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicOrchestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_orchestrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sheet_music_id')->unsigned();
            $table->foreign('sheet_music_id')->references('id')->on('sheet_musics')->onDelete('cascade');
            $table->string('file_name');
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
        Schema::drop('music_orchestations');
    }
}
