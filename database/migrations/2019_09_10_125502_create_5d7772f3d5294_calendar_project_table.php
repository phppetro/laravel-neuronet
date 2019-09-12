<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5d7772f3d5294CalendarProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('calendar_project')) {
            Schema::create('calendar_project', function (Blueprint $table) {
                $table->integer('calendar_id')->unsigned()->nullable();
                $table->foreign('calendar_id', 'fk_p_290529_290482_projec_5d7772f3d53b8')->references('id')->on('calendars')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_290482_290529_calend_5d7772f3d544b')->references('id')->on('projects')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_project');
    }
}
