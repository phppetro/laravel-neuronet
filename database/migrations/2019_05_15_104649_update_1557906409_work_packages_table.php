<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1557906409WorkPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_packages', function (Blueprint $table) {
            if(Schema::hasColumn('work_packages', 'number')) {
                $table->dropColumn('number');
            }
            
        });
Schema::table('work_packages', function (Blueprint $table) {
            
if (!Schema::hasColumn('work_packages', 'number')) {
                $table->string('number')->nullable();
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
        Schema::table('work_packages', function (Blueprint $table) {
            $table->dropColumn('number');
            
        });
Schema::table('work_packages', function (Blueprint $table) {
                        $table->string('number')->nullable();
                
        });

    }
}
