<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedDocumentTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_documents',function(Blueprint $table)
        {

            $table->increments('id');

            $table->string('user_id',20)->nullable();

            $table->string('tracking_id',20);

            $table->string('count_tracking',3);

            $table->string('person_received',32);

            $table->string('reason_requesting',64);

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
        Schema::dropIfExists('received_documents');
    }
}
