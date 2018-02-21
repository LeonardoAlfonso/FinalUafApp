<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacteristicEntry extends Model
{
    //Atributes
      protected $table = "characteristicsEntries";
      protected $fillable = ['nameCharacteristic','valueCharacteristic','idEntry'];
      protected $primaryKey = 'idCharacteristic';

    //Relations
      public function Entry()
      {
          return $this->belongsTo('App\Models\Entry', 'idEntry', 'idEntry');
      }
}
