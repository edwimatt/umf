<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageToCourseContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_to_course_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->default(0);
            $table->integer('language_id')->default(0);
            $table->text('lecture_number')->nullable();
            $table->text('lecture_heading')->nullable();
            $table->text('lecture_content')->nullable();
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
        Schema::drop('language_to_course_contents');
    }
}
