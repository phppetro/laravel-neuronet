<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1564658798CalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            if(Schema::hasColumn('calendars', 'end_date')) {
                $table->dropColumn('end_date');
            }
            
        });
Schema::table('calendars', function (Blueprint $table) {
            
if (!Schema::hasColumn('calendars', 'end_date')) {
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
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropColumn('end_date');
            
        });
Schema::table('calendars', function (Blueprint $table) {
                        $table->string('end_date')->nullable();
                
        });

    }
}
