<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568020480DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            if(Schema::hasColumn('deliverables', 'deliverable_id')) {
                $table->dropColumn('deliverable_id');
            }
            
        });
Schema::table('deliverables', function (Blueprint $table) {
            
if (!Schema::hasColumn('deliverables', 'deliverable_number')) {
                $table->string('deliverable_number')->nullable();
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
            $table->dropColumn('deliverable_number');
            
        });
Schema::table('deliverables', function (Blueprint $table) {
                        $table->string('deliverable_id')->nullable();
                
        });

    }
}
