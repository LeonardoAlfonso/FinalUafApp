<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUtilities extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('Utilities')) {
            Schema::create('Utilities', function (Blueprint $table) {
                $table->increments('idUtility');
                $table->double('egress',12,2);
                $table->double('entries',12,2);
                $table->double('utility',12,2);
                $table->integer('period');
                $table->timestamps();
                $table->integer('idSystem')->unsigned()->nullable();
  
            //Llaves
              $table->foreign('idSystem')->references('idSystem')->on('systems')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('Utilities');
    }
}
