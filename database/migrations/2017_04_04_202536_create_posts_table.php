<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post');
            $table->string('title');
            $table->integer('author')->unsigned();
            $table->integer('type')->unsigned();
            $table->integer('hash')->unsigned();
            $table->string('image');
            $table->timestamps();
            $table->foreign('author')->references('nickname')->on('authors')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type')->references('type')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('hash')->references('hash')->on('types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
