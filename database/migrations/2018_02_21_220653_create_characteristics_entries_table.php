<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsEntriesTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('characteristicsEntries')){
            Schema::create('characteristicsEntries', function (Blueprint $table) {
                $table->increments('idCharacteristic');
                $table->string('nameCharacteristic',100);
                $table->string('valueCharacteristic',100);
                $table->timestamps();

                $table->integer('idEntry')->unsigned()->nullable();
                $table->foreign('idEntry')->references('idEntry')->on('entries')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('characteristicsEntries');
    }
}
