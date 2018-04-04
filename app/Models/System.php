<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    //Attibutes
      protected $table = "systems";
      protected $fillable = ['nameSystem','autor','jornalValue','idZone'];
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

    public function Indicators()
    {
        return $this->hasMany('App\Models\SystemIndicator', 'idSystem', 'idSystem');
    }

    public function Utilities()
    {
        return $this->belongsTo('App\Models\Utility', 'idSystem', 'idSystem');
    }
}
