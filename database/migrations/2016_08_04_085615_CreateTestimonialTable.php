<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('villa_id');
            $table->string('guest_name');
            $table->text('comments')->nullable()->default(null);
            // $table->enum('type', ['manual', 'auto'])->default('auto');
            $table->enum('status', ['send', 'draft', 'live'])->default('send');
            // $table->dateTime('exp_date')->nullable();
            $table->integer('created_by');
            $table->timestamps();
            $table->string('city')->nullable()->default(null);         
            $table->unsignedInteger('country_id');/*Line 14*/
        });

        Schema::table('testimonials', function($table) {
            $table->foreign('country_id')
                  ->references('id')
                  ->on('countries');
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
        Schema::dropIfExists('testimonials');
    }
}