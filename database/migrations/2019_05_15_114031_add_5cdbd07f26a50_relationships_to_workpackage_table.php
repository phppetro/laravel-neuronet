<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5cdbd07f26a50RelationshipsToWorkPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_packages', function(Blueprint $table) {
            if (!Schema::hasColumn('work_packages', 'name_id')) {
                $table->integer('name_id')->unsigned()->nullable();
                $table->foreign('name_id', '304052_5cdbd07bb9b4e')->references('id')->on('wps')->onDelete('cascade');
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
