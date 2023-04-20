<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quiz_answers', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('user_id')->default(0);
            $table->integer('user_quiz_id')->default(0);
            $table->integer('quiz_question_id')->default(0);
            $table->integer('quiz_answer_id')->default(0);
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
        Schema::dropIfExists('user_quiz_answers');
    }
}
