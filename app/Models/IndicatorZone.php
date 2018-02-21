<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndicatorZone extends Model
{
  //Atributes
    protected $table = "indicatorsZones";
    protected $fillable = ['nameIndicator','valueIndicator','idZone'];
    protected $primaryKey = 'idIndicator';

  //Relations
    public function Departaments()
    {
        return $this->belongsTo('App\Models\Zone', 'idZone', 'idZone');
    }
}
