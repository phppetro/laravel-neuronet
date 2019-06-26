<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1561561096ContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if(Schema::hasColumn('contacts', 'phone1')) {
                $table->dropColumn('phone1');
            }
            if(Schema::hasColumn('contacts', 'phone2')) {
                $table->dropColumn('phone2');
            }
            if(Schema::hasColumn('contacts', 'skype')) {
                $table->dropColumn('skype');
            }
            if(Schema::hasColumn('contacts', 'address')) {
                $table->dropColumn('address');
            }
            
        });
Schema::table('contacts', function (Blueprint $table) {
            
if (!Schema::hasColumn('contacts', 'position')) {
                $table->string('position')->nullable();
                }
if (!Schema::hasColumn('contacts', 'instutution')) {
                $table->string('instutution')->nullable();
                }
if (!Schema::hasColumn('contacts', 'projects_involved')) {
                $table->string('projects_involved')->nullable();
                }
if (!Schema::hasColumn('contacts', 'expertise')) {
                $table->text('expertise')->nullable();
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
            $table->dropColumn('position');
            $table->dropColumn('instutution');
            $table->dropColumn('projects_involved');
            $table->dropColumn('expertise');
            
        });
Schema::table('contacts', function (Blueprint $table) {
                        $table->string('phone1')->nullable();
                $table->string('phone2')->nullable();
                $table->string('skype')->nullable();
                $table->string('address')->nullable();
                
        });

    }
}
