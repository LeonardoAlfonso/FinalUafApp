<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlossaryTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('glossary')) {

          Schema::create('glossary', function (Blueprint $table) {
              $table->increments('idWord');
              $table->string('group',1);
              $table->string('word',100);
              $table->text('definition');
              $table->timestamps();
          });
        }
    }

    public function down()
    {
        Schema::dropIfExists('glossary');
    }
}
