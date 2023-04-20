<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('quiz_question_id')->default(0);
            $table->integer('language_id')->default(1);
            $table->string('answer_option_title')->nullable();
            $table->text('answer_title')->nullable();
            $table->tinyInteger('is_correct_answer')->default(0);

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
        Schema::drop('quiz_answers');
    }
}
