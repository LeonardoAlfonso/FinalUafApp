<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsZonesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('characteristicsZones')) {

          Schema::create('characteristicsZones', function (Blueprint $table) {
              $table->increments('idCharacteristic');
              $table->string('nameCharacteristic',100);
              $table->string('valueCharacteristic',100);
              $table->string('showCharacteristic');
              $table->timestamps();

              $table->integer('idZone')->unsigned()->nullable();
              $table->foreign('idZone')->references('idZone')->on('zones')->onDelete('cascade');
          });
        }
    }

    public function down()
    {
        Schema::dropIfExists('characteristicsZones');
    }
}
