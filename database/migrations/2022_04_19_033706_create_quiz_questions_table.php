<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('course_quiz_id')->default(0);
            $table->integer('course_id')->default(0);
            $table->integer('language_id')->default(1);
            $table->string('question_option_title')->nullable();
            $table->text('question_title')->nullable();
            $table->tinyInteger('is_multiple_choice_question')->default(0);

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
        Schema::drop('quiz_questions');
    }
}
