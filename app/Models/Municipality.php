<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //Attributes
      protected $table = "municipalities";
      protected $fillable = ['name','idZone'];
      protected $primaryKey = 'idMunicipality';

      //Relations
      public function Zone()
      {
          return $this->belongsTo('App\Models\Zone', 'idZone', 'idZone');
      }
}
