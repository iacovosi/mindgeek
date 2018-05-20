<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
           // $table->foreign('type_id')->references('id')->on('types');  
            $table->integer('user_id');
           // $table->foreign('user_id')->references('id')->on('users');  
            $table->integer('chatroom_id')->nullable();
           // $table->foreign('chatroom_id')->references('id')->on('chat_rooms');              
            $table->text('text');
            $table->dateTime('sendAt')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
