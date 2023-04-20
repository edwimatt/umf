<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_certificates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('course_id')->default(0);
            $table->integer('language_id')->default(1);
            $table->string('course_certificate_title')->nullable();
            $table->text('course_certificate_file')->nullable();

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
        Schema::drop('course_certificates');
    }
}
