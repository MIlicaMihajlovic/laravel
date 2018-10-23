<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->text('text');

            $table->unsignedInteger('post_id'); //unsigned znaci da ne  moze da bude negativan
            $table->foreign('post_id')  //vezujemo za post
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade'); //kad se obrise post da se obrisu svi komentari

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
        Schema::dropIfExists('comments');
    }
}
