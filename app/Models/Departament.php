<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
  //Attributes
    protected $table = "departaments";
    protected $fillable = ['idDivipola','departamentName'];
    protected $primaryKey = 'idDepartament';

  //Relations
    public function zones()
    {
        return $this->hasMany('App\Models\Zone', 'idDepartament', 'idDepartament');
    }
}
