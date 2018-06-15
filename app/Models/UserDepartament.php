<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDepartament extends Model
{
    //Atributes
      protected $table = "usersDepartaments";
      protected $fillable = ['idDepartament', 'idUser'];
}
