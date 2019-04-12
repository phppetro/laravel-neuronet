<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1554993532PublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('publications')) {
            Schema::create('publications', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->string('year')->nullable();
                $table->integer('month')->nullable();
                $table->string('abbr')->nullable();
                $table->string('link')->nullable();
                $table->string('authors')->nullable();
                
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
        Schema::dropIfExists('publications');
    }
}
