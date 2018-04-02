<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVillages extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('villages')) {

          Schema::create('villages', function (Blueprint $table) {
              $table->increments('idVillage');
              $table->string('namevillage',50);
              $table->timestamps();

              $table->integer('idMunicipality')->unsigned()->nullable();
              $table->foreign('idMunicipality')->references('idMunicipality')->on('municipalities')->onDelete('cascade');
          });
        }
    }

    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
