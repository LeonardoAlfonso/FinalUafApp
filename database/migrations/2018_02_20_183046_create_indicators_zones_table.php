<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsZonesTable extends Migration
{
    public function up()
    {

      if (!Schema::hasTable('indicatorsZones')) {

        Schema::create('indicatorsZones', function (Blueprint $table) {
            $table->increments('idIndicator');
            $table->string('nameIndicator',100);
            $table->string('valueIndicator',100);
            $table->string('showIndicator');
            $table->timestamps();

            $table->integer('idZone')->unsigned()->nullable();
            $table->foreign('idZone')->references('idZone')->on('zones')->onDelete('cascade');
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('indicatorsZones');
    }
}
