<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1567758359WorkPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_packages', function (Blueprint $table) {
            if(Schema::hasColumn('work_packages', 'name_id')) {
                $table->dropForeign('304052_5cdbd07bb9b4e');
                $table->dropIndex('304052_5cdbd07bb9b4e');
                $table->dropColumn('name_id');
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
                        
        });

    }
}
