<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d8e1eafa8542RelationshipsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            if (!Schema::hasColumn('users', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '290417_5cd594e9113f5')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('users', 'professional_category_id')) {
                $table->integer('professional_category_id')->unsigned()->nullable();
                $table->foreign('professional_category_id', '290417_5cd594e92d82c')->references('id')->on('professional_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('users', 'education_id')) {
                $table->integer('education_id')->unsigned()->nullable();
                $table->foreign('education_id', '290417_5cd594e94ca7d')->references('id')->on('education')->onDelete('cascade');
                }
                if (!Schema::hasColumn('users', 'country_id')) {
                $table->integer('country_id')->unsigned()->nullable();
                $table->foreign('country_id', '290417_5cd594e96f4c8')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::table('users', function(Blueprint $table) {
            
        });
    }
}
