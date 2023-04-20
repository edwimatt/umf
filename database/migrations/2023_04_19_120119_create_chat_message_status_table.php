<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessageStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_message_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',11)->default(0);
            $table->integer('chat_room_id',11)->default(0);
            $table->integer('chat_message_id',11)->default(0);
            $table->tinyInteger('is_read')->default(0);
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
        Schema::dropIfExists('chat_message_status');
    }
}
