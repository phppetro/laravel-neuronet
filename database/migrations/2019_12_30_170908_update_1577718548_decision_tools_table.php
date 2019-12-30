<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1577718548DecisionToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('decision_tools', function (Blueprint $table) {
            
if (!Schema::hasColumn('decision_tools', 'target')) {
                $table->string('target')->nullable();
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
        Schema::table('decision_tools', function (Blueprint $table) {
            $table->dropColumn('target');
            
        });

    }
}
