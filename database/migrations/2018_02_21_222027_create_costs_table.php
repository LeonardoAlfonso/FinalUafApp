<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('costs')){
            Schema::create('costs', function (Blueprint $table) {
                $table->increments('idCost');
                $table->string('detail');
                $table->string('group');
                $table->string('subGroup');
                $table->double('unitaryCost');
                $table->integer('quantity')->nullable();
                $table->integer('period')->nullable();
                $table->double('total');
                $table->string('rememberToken',20);
                $table->timestamps();

                $table->integer('idSystem')->unsigned()->nullable();
                $table->foreign('idSystem')->references('idSystem')->on('systems')->onDelete('cascade');

            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
