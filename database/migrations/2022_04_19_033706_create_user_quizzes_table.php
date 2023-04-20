<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quizzes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->default(0);
            $table->integer('course_quiz_id')->default(0);
            $table->integer('quiz_percentage')->default(0);
            $table->tinyInteger('is_quiz_completed')->default(0);
            $table->tinyInteger('is_quiz_passed')->default(0);
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
        Schema::drop('user_quizzes');
    }
}
