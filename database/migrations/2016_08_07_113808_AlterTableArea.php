<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('areas',function(Blueprint $table){  
            $table->text('description')->nullable()->after('slug');       
            $table->decimal('longitude', 11, 8)->default(0)->after('description');
            $table->decimal('latitude', 10, 8)->default(0)->after('longitude');
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
    }
}
