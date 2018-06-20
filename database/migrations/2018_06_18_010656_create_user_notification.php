<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_notifications',function($table){

            $table->increments('id');

            $table->string('user_id',20)->nullable();

            $table->string('tracking_id',20);

            $table->string('message');

            $table->boolean('status');

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
        schema::dropIfExists('user_notifications');
    }
}
