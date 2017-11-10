<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('villa_id');
            $table->string('guest_name');
            $table->text('comments')->nullable()->default(null);
            $table->enum('type', ['manual', 'auto'])->default('auto');
            $table->enum('status', ['send', 'draft', 'live'])->default('send');
            $table->dateTime('arrival_date')->nullable();
            $table->dateTime('dept_date')->nullable();
            $table->dateTime('exp_date')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
