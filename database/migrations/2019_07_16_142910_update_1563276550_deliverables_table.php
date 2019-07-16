<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563276550DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            if(Schema::hasColumn('deliverables', 'label')) {
                $table->dropColumn('label');
            }
            if(Schema::hasColumn('deliverables', 'wp_id')) {
                $table->dropForeign('290509_5cdbe70b0cdea');
                $table->dropIndex('290509_5cdbe70b0cdea');
                $table->dropColumn('wp_id');
            }
            
        });
Schema::table('deliverables', function (Blueprint $table) {
            
if (!Schema::hasColumn('deliverables', 'submission_date')) {
                $table->date('submission_date')->nullable();
                }
if (!Schema::hasColumn('deliverables', 'keywords')) {
                $table->text('keywords')->nullable();
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
            $table->dropColumn('submission_date');
            $table->dropColumn('keywords');
            
        });
Schema::table('deliverables', function (Blueprint $table) {
                        $table->string('label')->nullable();
                
        });

    }
}
