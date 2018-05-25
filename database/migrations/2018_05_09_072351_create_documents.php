<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents',function(Blueprint $table){
            $table->increments('id');
            $table->string('document_category_id',16);
            $table->string('document_no',16)->Nullable();
            $table->string('office',64);
            $table->string('name',64);
            $table->string('document_content',64);
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
        
        Schema::dropIfExists('documents');

    }

}
