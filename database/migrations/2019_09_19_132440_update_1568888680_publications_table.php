<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568888680PublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            if(Schema::hasColumn('publications', 'keywords')) {
                $table->dropColumn('keywords');
            }
            
        });
Schema::table('publications', function (Blueprint $table) {
            
if (!Schema::hasColumn('publications', 'keywords')) {
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
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('keywords');
            
        });
Schema::table('publications', function (Blueprint $table) {
                        $table->string('keywords')->nullable();
                
        });

    }
}
