<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestForDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_documents',function(Blueprint $table){

            $table->increments('id');

            $table->string('request_no',20)->nullable();

            $table->string('user_id',20)->nullable();

            $table->string('document_no',20);

            $table->string('receiver',64);

            $table->boolean('status');

            $table->boolean('soft_delete');

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
        Schema::dropIfExists('request_documents');
    }
}
