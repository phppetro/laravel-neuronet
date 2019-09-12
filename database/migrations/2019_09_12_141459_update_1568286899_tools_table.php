<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568286899ToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            if(Schema::hasColumn('tools', 'description')) {
                $table->dropColumn('description');
            }
            
        });
Schema::table('tools', function (Blueprint $table) {
            
if (!Schema::hasColumn('tools', 'description')) {
                $table->text('description')->nullable();
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
        Schema::table('tools', function (Blueprint $table) {
            $table->dropColumn('description');
            
        });
Schema::table('tools', function (Blueprint $table) {
                        $table->string('description')->nullable();
                
        });

    }
}
