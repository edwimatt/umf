<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationIdentifierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_identifier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->nullable();
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->enum('notification_type',['push', 'email', 'none', 'web'])->nullable();
            $table->enum('send_type',['actor', 'target', 'both'])->nullable();
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
        Schema::drop('notification_identifier');
    }
}
