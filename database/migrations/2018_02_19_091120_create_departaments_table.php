<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentsTable extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('departaments')) {

        Schema::create('departaments', function (Blueprint $table) {
            $table->increments('idDepartament');
            $table->integer('idDivipola')->unsigned()->nullable();;
            $table->string('departamentName',50);
            $table->timestamps();
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('departaments');
    }
}
