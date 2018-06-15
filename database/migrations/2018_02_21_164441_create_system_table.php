<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    public function up()
    {
        if(!Schema::hasTable('systems')){
            Schema::create('systems', function (Blueprint $table) {
                $table->increments('idSystem');
                $table->string('nameSystem');
                $table->string('autor');
                $table->double('jornalValue')->nullable();
                $table->timestamps();

                $table->integer('idZone')->unsigned()->nullable();
                $table->foreign('idZone')->references('idZone')->on('zones')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('systems');
    }
}
