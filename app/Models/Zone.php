<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //Attributes
      protected $table = "zones";
      protected $fillable = ['nameZone','autor','miniMapPath','idDepartament'];
      protected $primaryKey = 'idZone';

      public function getFileNameAttribute()
      {
          $minimap = $this->miniMapPath;
          $minimapName = substr($minimap, strripos($minimap, "/") + 1);
          return $minimapName;
      }

  //Relations
      public function Departament()
      {
          return $this->belongsTo('App\Models\Departament', 'idDepartament', 'idDepartament');
      }

      public function Characteristics()
      {
          return $this->hasMany('App\Models\CharacteristicZone', 'idZone', 'idZone');
      }

      public function Indicators()
      {
          return $this->hasMany('App\Models\IndicatorZone', 'idZone', 'idZone');
      }

      public function Systems()
      {
          return $this->hasMany('App\Models\System', 'idZone', 'idZone');
      }

      public function Municipalities()
      {
          return $this->belongsToMany('App\Models\Municipality', 'zonesMunicipalities', 'idZone', 'idMunicipality');
      }
}
