<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d7a564aa9c10RelationshipsToCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function(Blueprint $table) {
            if (!Schema::hasColumn('calendars', 'color_id')) {
                $table->integer('color_id')->unsigned()->nullable();
                $table->foreign('color_id', '290529_5d42cc6e98f11')->references('id')->on('colors')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function(Blueprint $table) {
            
        });
    }
}
