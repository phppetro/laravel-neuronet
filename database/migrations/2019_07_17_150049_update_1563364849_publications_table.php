<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563364849PublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            if(Schema::hasColumn('publications', 'month')) {
                $table->dropColumn('month');
            }
            if(Schema::hasColumn('publications', 'abbr')) {
                $table->dropColumn('abbr');
            }
            if(Schema::hasColumn('publications', 'authors')) {
                $table->dropColumn('authors');
            }
            
        });
Schema::table('publications', function (Blueprint $table) {
            
if (!Schema::hasColumn('publications', 'first_author_last_name')) {
                $table->string('first_author_last_name')->nullable();
                }
if (!Schema::hasColumn('publications', 'keywords')) {
                $table->string('keywords')->nullable();
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
            $table->dropColumn('first_author_last_name');
            $table->dropColumn('keywords');
            
        });
Schema::table('publications', function (Blueprint $table) {
                        $table->integer('month')->nullable();
                $table->string('abbr')->nullable();
                $table->string('authors')->nullable();
                
        });

    }
}
