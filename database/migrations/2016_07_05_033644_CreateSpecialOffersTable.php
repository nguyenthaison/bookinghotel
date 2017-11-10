<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('special_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('villa_id');
            $table->string('title');
            $table->dateTime('period_start');
            $table->dateTime('period_end');
            $table->string('discount')->nullable();
            $table->string('other')->nullable();
            $table->integer('created_by');
            $table->timestamps();

            $table->foreign('villa_id')->references('id')->on('villas')
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
        Schema::dropIfExists('special_offers');

    }
}
