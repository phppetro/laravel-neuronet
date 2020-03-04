<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('asset_maps')) {
            Schema::create('asset_maps', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('body')->nullable();
                $table->string('target')->nullable();
                $table->integer('project_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('asset_maps');
    }
}
