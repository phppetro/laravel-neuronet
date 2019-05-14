<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5cdae3c66c90bRelationshipsToPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function(Blueprint $table) {
            if (!Schema::hasColumn('partners', 'type_of_institution_id')) {
                $table->integer('type_of_institution_id')->unsigned()->nullable();
                $table->foreign('type_of_institution_id', '304039_5cdae3c20ddc7')->references('id')->on('type_of_institutions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('partners', 'country_id')) {
                $table->integer('country_id')->unsigned()->nullable();
                $table->foreign('country_id', '304039_5cdae3c22c6fe')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::table('partners', function(Blueprint $table) {
            
        });
    }
}
