<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d7f786cd535cRelationshipsToWorkPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_packages', function(Blueprint $table) {
            if (!Schema::hasColumn('work_packages', 'wp_number_id')) {
                $table->integer('wp_number_id')->unsigned()->nullable();
                $table->foreign('wp_number_id', '304052_5d7218181369c')->references('id')->on('wps')->onDelete('cascade');
                }
                if (!Schema::hasColumn('work_packages', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '304052_5cdbd07bcdb58')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('work_packages', function(Blueprint $table) {
            
        });
    }
}
