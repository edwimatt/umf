<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_group_id')->default(0);
            $table->integer('company_id')->default(0);
            $table->integer('language_id')->default(0);
            $table->string('user_type')->default("physician");
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email', 150)->nullable();
            $table->string('mobile_no', 150)->nullable();
            $table->string('password', 100)->nullable();
            $table->integer('hospital_id', 100)->nullable();
            $table->integer('speciality_id', 100)->nullable();
            $table->integer('department_id', 100)->nullable();
            $table->string('social_id', 100)->nullable();
            $table->string('social_type', 100)->nullable();
            $table->integer('gateway_user_id')->nullable();
            $table->integer('age')->default(0);
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('referral', 100)->nullable();
            $table->text('image_url')->nullable();
            $table->decimal('rating', 9, 2)->default(0);
            $table->enum('gender',['male', 'female'])->nullable();

            $table->text('website')->nullable();
            $table->text('about_me')->nullable();
            $table->string('website',150)->nullable();
            $table->string('device_type',150)->nullable();
            $table->string('device_token',150)->nullable();
            $table->string('device',150)->nullable();
            $table->string('token',150)->nullable();
            $table->string('forgot_password_hash',150)->nullable();
            $table->timestamp('token_expiry_at')->nullable();
            $table->timestamp('subscription_expiry_date')->nullable();
            $table->timestamp('forgot_password_hash_date')->nullable();
            $table->integer('subscription_id')->default(0);

            $table->string('user_scheduling_status')->nullable();
            $table->tinyInteger('is_plan_subscribed')->default(0);
            $table->timestamp('plan_expiry_date')->nullable();
            $table->timestamp('purchase_date')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->integer('online_status')->default(0);
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('user');
    }
}
