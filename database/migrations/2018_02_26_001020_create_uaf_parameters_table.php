<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUafParametersTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('uafParameters')){
          Schema::create('uafParameters', function (Blueprint $table) {
              $table->increments('idParameter');
              $table->string('nameParameter');
              $table->string('showParameter');
              $table->decimal('valueParameter');

              $table->timestamps();
          });
        }
    }

    public function down()
    {
        Schema::dropIfExists('uafParameters');
    }
}
