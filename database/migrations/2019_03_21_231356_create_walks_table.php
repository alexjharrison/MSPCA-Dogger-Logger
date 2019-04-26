<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walks', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->boolean('pooped');
            $table->boolean('peed');
            $table->text('medical_concern')->nullable();
            $table->integer('jumps')->unsigned();
            $table->text('jump_handlage')->nullable();
            $table->integer('mouthings')->unsigned();
            $table->text('mouthings_handlage')->nullable();
            $table->integer('dogs_seen_reacted')->unsigned();
            $table->text('seen_dog_reaction')->nullable();
            $table->integer('dogs_seen')->unsigned();
            $table->text('other_concerns')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('dog_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dog_id')->references('id')->on('dogs')->onDelete('cascade');
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
        Schema::dropIfExists('walks');
    }
}
