<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1564140724ToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            
if (!Schema::hasColumn('tools', 'publication_date')) {
                $table->date('publication_date')->nullable();
                }
if (!Schema::hasColumn('tools', 'type_of_data_available')) {
                $table->string('type_of_data_available')->nullable();
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
            $table->dropColumn('publication_date');
            $table->dropColumn('type_of_data_available');
            
        });

    }
}
