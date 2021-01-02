<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighlightsMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('highlights_metrics')) {
            Schema::create('highlights_metrics', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('image')->nullable();
                $table->integer('number')->nullable()->unsigned();
                $table->string('name')->nullable();
                $table->string('order')->nullable();

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
        Schema::dropIfExists('highlights_metrics');
    }
}
