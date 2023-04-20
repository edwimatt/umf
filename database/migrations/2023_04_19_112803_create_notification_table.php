<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_identifier_id')->default(0);
            $table->integer('actor_id')->default(0);
            $table->integer('target_id')->default(0);
            $table->integer('reference_id')->default(0);
            $table->string('reference_module', 50);
            $table->enum('type', ['push', 'email']);
            $table->string('title',100);
            $table->mediumText('description');
            $table->tinyInteger('is_notify_expired');
            $table->tinyInteger('is_read');
            $table->tinyInteger('is_viewed');
            $table->tinyInteger('is_anonymous');
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
        Schema::dropIfExists('notification');
    }
}
