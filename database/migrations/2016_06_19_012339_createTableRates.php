<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('villa_id');
            $table->unsignedInteger('season_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('min_stay')->nullable();
            $table->decimal('tax', 4, 2)->default(0);
            $table->integer('plus')->default(0);
            $table->decimal('rate', 8, 2);
            $table->integer('created_by');
            $table->timestamps();

            $table->foreign('villa_id')->references('id')->on('villas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')
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
        Schema::dropIfExists('rates');
    }
}
