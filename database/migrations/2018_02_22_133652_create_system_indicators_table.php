<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemIndicatorsTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('systemIndicators')){
            Schema::create('systemIndicators', function (Blueprint $table) {
                $table->increments('idIndicator');
                $table->string('nameIndicator');
                $table->double('valueIndicator');
                $table->timestamps();

                $table->integer('idSystem')->unsigned()->nullable();
                $table->foreign('idSystem')->references('idSystem')->on('systems')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('systemIndicators');
    }
}
