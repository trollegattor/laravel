<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{

    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categories_id')->unsigned()->default(1);
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->char('title',200);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}

