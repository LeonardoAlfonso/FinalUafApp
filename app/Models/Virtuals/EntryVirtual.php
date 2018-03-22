<?php

namespace App\Models\Virtuals;

use Illuminate\Database\Eloquent\Model;

class EntryVirtual extends Model
{
    protected $fillable = ['id','name','unitaryPrice','measureUnity','priceSource','datePriceSource',
                            'quantity1','quantity2','quantity3', 'quantity4', 'quantity5','quantity6',
                            'quantity7','quantity8','quantity9', 'quantity10', 'quantity11','quantity12'];
}
