<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id',11)->default(0);
            $table->string('category_type',33)->default("quiz");
            $table->string('category_name',225)->nullable();
            $table->string('short_name',100)->nullable();
            $table->string('spanish_category_name',100)->nullable();
            $table->text('spanish_description')->nullable();
            $table->text('description')->nullable();
            $table->text('certificate_requirement')->nullable();
            $table->text('certificate_confirmation')->nullable();
            $table->integer('display_order')->default(0);
            $table->tinyInteger('is_show_on_place_ad')->default(0);
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
