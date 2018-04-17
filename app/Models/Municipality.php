<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //Attributes
      protected $table = "municipalities";
      protected $fillable = ['nameMunicipality', 'idDepartament'];
      protected $primaryKey = 'idMunicipality';

      //Relations
      public function Departament()
      {
          return $this->belongsTo('App\Models\Departament', 'idDepartament', 'idDepartament');
      }

      public function Zones()
      {
          return $this->belongsToMany('App\Models\Zones', 'zonesMunicipalities', 'idMunicipality', 'idZone');
      }

      public function Villages()
      {
          return $this->hasMany('App\Models\Village', 'idMunicipality', 'idMunicipality');
      }
}