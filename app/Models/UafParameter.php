<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UafParameter extends Model
{
    //Atributes
      protected $table = "uafParameters";
      protected $fillable = ['nameParameter','valueParameter', 'showParameter'];
      protected $primaryKey = 'idParameter';

}
