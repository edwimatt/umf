<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_to_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->default(0);
            $table->integer('language_id')->default(0);
            $table->string('course_type')->default("quiz");
            $table->string('course_name')->nullable();
            $table->text('video_file')->nullable();
            $table->text('video_file_thumb')->nullable();
            $table->text('video_heading')->nullable();
            $table->text('video_description')->nullable();
            $table->tinyInteger('is_intro')->default(0);
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
        Schema::drop('language_to_courses');
    }
}
