<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by',11)->default(0);
            $table->string('slug',200)->nullable();
            $table->string('identifier',200)->nullable();
            $table->string('title',200)->nullable();
            $table->text('image_url',33)->nullable();
            $table->text('description',33)->nullable();
            $table->string('member_limit',100)->nullable();
            $table->enum('type',['single', 'group'])->default("single");
            $table->tinyInteger('is_anonymous')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('chat_rooms');
    }
}
