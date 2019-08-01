<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d42cc7633f59RelationshipsToCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function(Blueprint $table) {
            if (!Schema::hasColumn('calendars', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '290529_5cd2a045cbc13')->references('id')->on('projects')->onDelete('cascade');
                }
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
