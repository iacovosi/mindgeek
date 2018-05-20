<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatroomUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatroom_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
           // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('chatroom_users');
    }
}
