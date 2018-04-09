<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowcashTable extends Migration
{

    public function up()
    {
        if (!Schema::hasTable('flowCash')) {
            Schema::create('flowCash', function (Blueprint $table) {
                $table->increments('idFlowCash');
                $table->double('finalCash',12,2);
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
        Schema::dropIfExists('flowCash');
    }
}
