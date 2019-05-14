<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5cdae3c668f87PartnerProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('partner_project')) {
            Schema::create('partner_project', function (Blueprint $table) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', 'fk_p_304039_290482_projec_5cdae3c669122')->references('id')->on('partners')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_290482_304039_partne_5cdae3c6691f6')->references('id')->on('projects')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_project');
    }
}
