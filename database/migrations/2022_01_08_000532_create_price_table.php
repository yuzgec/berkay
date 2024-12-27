<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTable extends Migration
{

    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');

            $table->integer('category')->default(1);
            $table->longText('desc')->nullable();

            $table->boolean('active')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('rank')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('price');
    }
}
