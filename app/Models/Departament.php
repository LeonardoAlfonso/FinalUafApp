<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
  //Attributes
    protected $table = "departaments";
    protected $fillable = ['idDivipola','departamentName'];
    protected $appends  = ['is_check'];
    protected $primaryKey = 'idDepartament';

  //Relations
    public function zones()
    {
        return $this->hasMany('App\Models\Zone', 'idDepartament', 'idDepartament');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'usersDepartaments', 'idDepartament', 'idUser');
    }

    public function Municipalities()
    {
        return $this->hasMany('App\Models\Municipality', 'idDepartament', 'idDepartament');
    }

    //Functions
    public function getIsCheckAttribute()
    {
        return $this->attributes['check'];
    }

    public function setIsCheckAttribute($validation)
    {
        $this->attributes['check'] = $validation;
    }
}
