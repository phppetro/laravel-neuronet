<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1564476884CalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            if(Schema::hasColumn('calendars', 'date')) {
                $table->dropColumn('date');
            }
            
        });
Schema::table('calendars', function (Blueprint $table) {
            
if (!Schema::hasColumn('calendars', 'start_date_and_time')) {
                $table->datetime('start_date_and_time')->nullable();
                }
if (!Schema::hasColumn('calendars', 'end_date_and_time')) {
                $table->datetime('end_date_and_time')->nullable();
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
            $table->dropColumn('start_date_and_time');
            $table->dropColumn('end_date_and_time');
            
        });
Schema::table('calendars', function (Blueprint $table) {
                        $table->datetime('date')->nullable();
                
        });

    }
}
