<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1567766180DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            
if (!Schema::hasColumn('deliverables', 'deliverable_id')) {
                $table->string('deliverable_id')->nullable();
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
            $table->dropColumn('deliverable_id');
            
        });

    }
}
