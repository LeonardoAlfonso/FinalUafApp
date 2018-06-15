<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{

    protected $table = "villages";
    protected $fillable = ['nameVillage', 'idMunicipality'];
    protected $primaryKey = 'idVillage';

    //Relations
    public function Municipalities()
    {
        return $this->belongsTo('App\Models\Municipality', 'idMunicipality', 'idMunicipality');
    }

}
