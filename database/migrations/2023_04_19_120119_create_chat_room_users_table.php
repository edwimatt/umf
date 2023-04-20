<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by',11)->default(0);
            $table->integer('chat_room_id',11)->default(0);;
            $table->integer('is_owner')->default(0);
            $table->integer('last_chat_message_id')->default(0);
            $table->integer('unread_message_counts')->default(0);
            $table->timestamp('last_message_timestamp')->nullable();
            $table->tinyInteger('is_anonymous')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_room_users');
    }
}
