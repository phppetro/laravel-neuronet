<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1557917758DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            if(Schema::hasColumn('deliverables', 'link')) {
                $table->dropColumn('link');
            }
            
        });
Schema::table('deliverables', function (Blueprint $table) {
            
if (!Schema::hasColumn('deliverables', 'link')) {
                $table->string('link')->nullable();
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
        Schema::table('deliverables', function (Blueprint $table) {
            $table->dropColumn('link');
            
        });
Schema::table('deliverables', function (Blueprint $table) {
                        $table->string('link')->nullable();
                
        });

    }
}
