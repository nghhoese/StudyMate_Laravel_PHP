<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->tinyInteger('achieved')->nullable();
            $table->unsignedInteger('teacher')->nullable();
            $table->foreign('teacher')->references('id')->on('teachers')->onDelete('cascade');;
            $table->unsignedInteger('coordinator')->nullable();
            $table->foreign('coordinator')->references('id')->on('teachers')->onDelete('cascade');;
            $table->integer('EC')->nullable();
            $table->string('block_name')->nullable();
            $table->foreign('block_name')->references('name')->on('blocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
