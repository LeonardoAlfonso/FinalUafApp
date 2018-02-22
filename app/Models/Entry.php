<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
  //Attibutes
    protected $table = "entries";
    protected $fillable = ['name','unitaryPrice','measureUnity','priceSource',
                            'datePriceSource','quantity','period','integralIndicator','total','idSystem'];
    protected $primaryKey = 'idEntry';

    //Relations
    public function System()
    {
        return $this->belongsTo('App\Models\System', 'idSystem', 'idSystem');
    }

    public function Characteristics()
    {
        return $this->hasMany('App\Models\CharacteristicEntry', 'idEntry', 'idEntry');
    }

}
