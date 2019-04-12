<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5caf5880e2669RelationshipsToPublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function(Blueprint $table) {
            if (!Schema::hasColumn('publications', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '290488_5caf518065cfe')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('publications', function(Blueprint $table) {
            if(Schema::hasColumn('publications', 'project_id')) {
                $table->dropForeign('290488_5caf518065cfe');
                $table->dropIndex('290488_5caf518065cfe');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
