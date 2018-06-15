<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    public function up()
    {
      if(!Schema::hasTable('entries')){
          Schema::create('entries', function (Blueprint $table) {
              $table->increments('idEntry');
              $table->string('name');
              $table->double('unitaryPrice');
              $table->string('measureUnity')->nullable();
              $table->string('priceSource')->nullable();
              $table->string('datePriceSource')->nullable();
              $table->integer('quantity')->nullable();
              $table->integer('period')->nullable();
              $table->double('total');
              $table->timestamps();

              $table->integer('idSystem')->unsigned()->nullable();
              $table->foreign('idSystem')->references('idSystem')->on('systems')->onDelete('cascade');
          });
      }
    }

    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
