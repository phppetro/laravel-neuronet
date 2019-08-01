<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1564655803CalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            if(Schema::hasColumn('calendars', 'start_date_and_time')) {
                $table->dropColumn('start_date_and_time');
            }
            if(Schema::hasColumn('calendars', 'end_date_and_time')) {
                $table->dropColumn('end_date_and_time');
            }
            
        });
Schema::table('calendars', function (Blueprint $table) {
            
if (!Schema::hasColumn('calendars', 'start_date')) {
                $table->date('start_date')->nullable();
                }
if (!Schema::hasColumn('calendars', 'end_date')) {
                $table->string('end_date')->nullable();
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
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            
        });
Schema::table('calendars', function (Blueprint $table) {
                        $table->datetime('start_date_and_time')->nullable();
                $table->datetime('end_date_and_time')->nullable();
                
        });

    }
}
