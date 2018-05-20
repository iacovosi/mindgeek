<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatroomMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatroom_messages', function (Blueprint $table) {
            $table->integer('message_id')->unsigned();
           // $table->foreign('message_id')->references('id')->on('messages');  
           $table->integer('chatroom_id')->unsigned();
           // $table->foreign('chatroom_id')->references('id')->on('chat_rooms');              
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
        Schema::dropIfExists('chatroom_messages');
    }
}
