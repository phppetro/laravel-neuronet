<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5cdbf0431b9beRelationshipsToDeliverableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverables', 'wp_id')) {
                $table->integer('wp_id')->unsigned()->nullable();
                $table->foreign('wp_id', '290509_5cdbe70b0cdea')->references('id')->on('work_packages')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverables', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '290509_5caf524b8cb7e')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('deliverables', function(Blueprint $table) {
            
        });
    }
}
