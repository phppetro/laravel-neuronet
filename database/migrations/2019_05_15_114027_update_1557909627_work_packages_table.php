<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1557909627WorkPackagesTable extends Migration
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
            if(Schema::hasColumn('work_packages', 'name')) {
                $table->dropColumn('name');
            }
            
        });
Schema::table('work_packages', function (Blueprint $table) {
            
if (!Schema::hasColumn('work_packages', 'description')) {
                $table->string('description')->nullable();
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
            $table->dropColumn('description');
            
        });
Schema::table('work_packages', function (Blueprint $table) {
                        $table->string('number')->nullable();
                $table->string('name')->nullable();
                
        });

    }
}
