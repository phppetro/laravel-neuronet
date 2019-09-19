<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568881704ActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            if(Schema::hasColumn('activities', 'body')) {
                $table->dropColumn('body');
            }
            
        });
Schema::table('activities', function (Blueprint $table) {
            
if (!Schema::hasColumn('activities', 'message')) {
                $table->text('message')->nullable();
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
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('message');
            
        });
Schema::table('activities', function (Blueprint $table) {
                        $table->string('body')->nullable();
                
        });

    }
}
