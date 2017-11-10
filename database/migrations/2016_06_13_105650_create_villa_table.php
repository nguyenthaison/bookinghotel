<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('villas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->unique();
            $table->string('slug', 150);
            $table->text('intro')->nullable();
            $table->text('description')->nullable();
            $table->text('services')->nullable();
            $table->text('facilities')->nullable();
            $table->text('staff_detail')->nullable();
            $table->text('term_condition')->nullable();
            $table->text('other')->nullable();
            $table->decimal('longitude', 11, 8)->default(0);
            $table->decimal('latitude', 10, 8)->default(0);
            $table->integer('occupied_max')->nullable();
            $table->integer('bedrooms_no')->nullable();
            $table->unsignedInteger('environment_id');
            $table->integer('staff_no')->nullable();
            $table->integer('position')->default(9999);
            $table->integer('created_by');
            $table->timestamps();

            $table->foreign('environment_id')->references('id')->on('environments')
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
        Schema::dropIfExists('villas');
    }
}
