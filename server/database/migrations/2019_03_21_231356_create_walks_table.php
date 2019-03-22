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
            $table->text('medical_concern');
            $table->integer('jumps')->unsigned();
            $table->text('jump_handlage');
            $table->integer('mouthings')->unsigned();
            $table->text('mouthings_handlage');
            $table->boolean('dog_reactions');
            $table->text('dog_reaction');
            $table->integer('times_seen_dog')->unsigned();
            $table->text('seen_dogs_reaction');
            $table->text('other_concerns');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('dog_id')->unsigned();
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
