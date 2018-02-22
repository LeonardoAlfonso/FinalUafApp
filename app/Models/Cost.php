<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    //Attibutes
      protected $table = "costs";
      protected $fillable = ['detail','group','subGroup','unitaryCost',
                              'quantity','period','total','idSystem'];
      protected $primaryKey = 'idCost';

      //Relations
      public function System()
      {
          return $this->belongsTo('App\Models\System', 'idSystem', 'idSystem');
      }
}
