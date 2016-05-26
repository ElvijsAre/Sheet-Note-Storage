<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_musics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('sheet_music_authors', function (Blueprint $table) {
            $table->integer('sheet_music_id')->unsigned();
            $table->foreign('sheet_music_id')->references('id')->on('sheet_musics')->onDelete('cascade');
            $table->integer('music_author_id')->unsigned();
            $table->foreign('music_author_id')->references('id')->on('music_authors')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('sheet_music_categories', function (Blueprint $table) {
            $table->integer('sheet_music_id')->unsigned();
            $table->foreign('sheet_music_id')->references('id')->on('sheet_musics')->onDelete('cascade');
            $table->integer('music_category_id')->unsigned();
            $table->foreign('music_category_id')->references('id')->on('music_categories')->onDelete('cascade');
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
        Schema::drop('sheet_music_authors');
        Schema::drop('sheet_music_categories');
        Schema::drop('sheet_musics');
    }
}
