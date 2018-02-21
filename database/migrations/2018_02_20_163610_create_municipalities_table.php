<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalitiesTable extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('municipalities')) {

          Schema::create('municipalities', function (Blueprint $table) {
              $table->increments('idMunicipality');
              $table->string('name',50);
              $table->timestamps();

              $table->integer('idZone')->unsigned()->nullable();
              $table->foreign('idZone')->references('idZone')->on('zones')->onDelete('cascade');
          });
        }
    }

    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
