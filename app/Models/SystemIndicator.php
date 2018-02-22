<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemIndicator extends Model
{
    //Attibutes
      protected $table = "systemIndicators";
      protected $fillable = ['nameIndicator','valueIndicator','idSystem'];
      protected $primaryKey = 'idIndicator';

      //Relations
      public function System()
      {
          return $this->belongsTo('App\Models\System', 'idSystem', 'idSystem');
      }
}
