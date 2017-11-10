<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGalleries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('villa_id');
            $table->unsignedInteger('group_id');
            $table->string('image');
            $table->string('caption')->nullable();
            $table->integer('position')->default(999);
            $table->integer('uploaded_by');
            $table->integer('updated_by');
            $table->timestamps();

            $table->foreign('villa_id')->references('id')->on('villas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('gallery_groups')
                ->onUpdate('cascade')->onDelete('cascade');    

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('galleries');
    }
}
