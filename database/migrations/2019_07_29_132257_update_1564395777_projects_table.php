<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1564395777ProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            if(Schema::hasColumn('projects', 'date')) {
                $table->dropColumn('date');
            }
            if(Schema::hasColumn('projects', 'duration')) {
                $table->dropColumn('duration');
            }
            
        });
Schema::table('projects', function (Blueprint $table) {
            
if (!Schema::hasColumn('projects', 'start_date')) {
                $table->date('start_date')->nullable();
                }
if (!Schema::hasColumn('projects', 'end_date')) {
                $table->date('end_date')->nullable();
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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            
        });
Schema::table('projects', function (Blueprint $table) {
                        $table->date('date')->nullable();
                $table->integer('duration')->nullable();
                
        });

    }
}
