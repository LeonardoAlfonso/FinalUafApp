<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneMunicipality extends Model
{
    //Atributes
    protected $table = "zonesMunicipalities";
    protected $fillable = ['idMunicipality', 'idZone'];
}
