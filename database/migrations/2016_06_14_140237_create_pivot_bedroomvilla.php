<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotBedroomvilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bedroom_villa', function (Blueprint $table) {
            $table->unsignedInteger('bedroom_id');
            $table->unsignedInteger('villa_id');

            $table->foreign('bedroom_id')
                ->references('id')
                ->on('bedrooms')
                ->onDelete('cascade');

            $table->foreign('villa_id')
                ->references('id')
                ->on('villas')
                ->onDelete('cascade');

            $table->primary(['bedroom_id', 'villa_id']);
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
        Schema::dropIfExists('bedroom_villa');
    }
}
