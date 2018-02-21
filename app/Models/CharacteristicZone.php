<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacteristicZone extends Model
{
  //Atributes
    protected $table = "characteristicsZones";
    protected $fillable = ['nameCharacteristic','valueCharacteristic','idZone'];
    protected $primaryKey = 'idCharacteristic';

  //Relations
    public function Departaments()
    {
        return $this->belongsTo('App\Models\Zone', 'idZone', 'idZone');
    }
}
