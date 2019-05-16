<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5cc817024e20eContentCategoryContentPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('content_category_content_page')) {
            Schema::create('content_category_content_page', function (Blueprint $table) {
                $table->integer('content_category_id')->unsigned()->nullable();
                $table->foreign('content_category_id', 'fk_p_298745_298747_conten_5cc817024e3c9')->references('id')->on('content_categories')->onDelete('cascade');
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_298747_298745_conten_5cc817024e4f1')->references('id')->on('content_pages')->onDelete('cascade');
                
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
        Schema::dropIfExists('content_category_content_page');
    }
}
