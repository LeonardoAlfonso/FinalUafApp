<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDepartamentsTable extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('usersDepartaments')) {
            Schema::create('usersDepartaments', function (Blueprint $table) {

                $table->integer('idDepartament')->unsigned()->nullable();
                $table->foreign('idDepartament')->references('idDepartament')->on('departaments');
                $table->timestamps();

                $table->integer('idUser')->unsigned()->nullable();
                $table->foreign('idUser')->references('idUser')->on('users');
            });
          }
    }

    public function down()
    {
        Schema::dropIfExists('usersDepartaments');
    }
}
