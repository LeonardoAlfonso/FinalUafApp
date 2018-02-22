<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    //Attibutes
      protected $table = "systems";
      protected $fillable = ['nameSystem','autor','uafMinimum','uafMaximum',
                              'uafIntegralMinimum','uafIntegralMaximum','jornalValue','idZone'];
      protected $primaryKey = 'idSystem';

    //Relations
    public function Zone()
    {
        return $this->belongsTo('App\Models\Zone', 'idZone', 'idZone');
    }

    public function Entries()
    {
        return $this->hasMany('App\Models\Entry', 'idSystem', 'idSystem');
    }

    public function Costs()
    {
        return $this->hasMany('App\Models\Cost', 'idSystem', 'idSystem');
    }
}
