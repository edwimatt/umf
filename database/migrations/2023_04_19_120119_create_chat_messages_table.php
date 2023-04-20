<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id',11)->default(0);
            $table->integer('chat_room_id',11)->default(0);
            $table->text('message',33)->nullable();
            $table->text('file_url',225)->nullable();
            $table->text('file_data',225)->nullable();
            $table->string('message_type',100)->nullable();
            $table->string('ip_address',100)->nullable();
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
        Schema::dropIfExists('chat_messages');
    }
}
