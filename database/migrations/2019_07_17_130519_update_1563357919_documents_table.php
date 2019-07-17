<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1563357919DocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if(Schema::hasColumn('documents', 'name')) {
                $table->dropColumn('name');
            }
            
        });
Schema::table('documents', function (Blueprint $table) {
            
if (!Schema::hasColumn('documents', 'title')) {
                $table->string('title')->nullable();
                }
if (!Schema::hasColumn('documents', 'source')) {
                $table->string('source')->nullable();
                }
if (!Schema::hasColumn('documents', 'publication_date')) {
                $table->date('publication_date')->nullable();
                }
if (!Schema::hasColumn('documents', 'keywords')) {
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
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('source');
            $table->dropColumn('publication_date');
            $table->dropColumn('keywords');
            
        });
Schema::table('documents', function (Blueprint $table) {
                        $table->string('name')->nullable();
                
        });

    }
}
