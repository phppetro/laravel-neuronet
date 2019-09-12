<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568109294CalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            if(Schema::hasColumn('calendars', 'project_id')) {
                $table->dropForeign('290529_5cd2a045cbc13');
                $table->dropIndex('290529_5cd2a045cbc13');
                $table->dropColumn('project_id');
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
        Schema::table('calendars', function (Blueprint $table) {
                        
        });

    }
}
