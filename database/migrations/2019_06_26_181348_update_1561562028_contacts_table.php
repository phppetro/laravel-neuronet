<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561562028ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'instutution')) {
                $table->dropColumn('instutution');
            }
            
        });
Schema::table('contacts', function (Blueprint $table) {
            
if (!Schema::hasColumn('contacts', 'institution')) {
                $table->string('institution')->nullable();
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('institution');
            
        });
Schema::table('contacts', function (Blueprint $table) {
                        $table->string('instutution')->nullable();
                
        });

    }
}
