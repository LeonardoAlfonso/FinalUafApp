<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesMunicipalities extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('zonesMunicipalities'))
        {
            Schema::create('zonesMunicipalities', function (Blueprint $table) {

                $table->integer('idMunicipality')->unsigned()->nullable();
                $table->foreign('idMunicipality')->references('idMunicipality')->on('municipalities');
                $table->timestamps();

                $table->integer('idZone')->unsigned()->nullable();
                $table->foreign('idZone')->references('idZone')->on('zones');
        });
        }
    }


    public function down()
    {
        Schema::dropIfExists('zonesMunicipalities');
    }
}
