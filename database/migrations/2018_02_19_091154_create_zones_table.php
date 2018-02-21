<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('zones')) {

          Schema::create('zones', function (Blueprint $table) {
              $table->increments('idZone');
              $table->string('nameZone',100);
              $table->string('autor',100);
              $table->string('miniMapPath',100);
              $table->timestamps();

              $table->integer('idDepartament')->unsigned()->nullable();
              $table->foreign('idDepartament')->references('idDepartament')->on('departaments')->onDelete('cascade');
          });
        }

    }

    public function down()
    {
        Schema::dropIfExists('zones');
    }
}
