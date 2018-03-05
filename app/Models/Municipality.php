<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //Attributes
      protected $table = "municipalities";
      protected $fillable = ['nameMunicipality', 'rememberToken', 'idZone'];
      protected $primaryKey = 'idMunicipality';

      //Relations
      public function Zone()
      {
          return $this->belongsTo('App\Models\Zone', 'idZone', 'idZone');
      }

      public function Villages()
      {
          return $this->hasMany('App\Models\Village', 'idMunicipality', 'idMunicipality');
      }
}
