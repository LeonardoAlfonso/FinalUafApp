<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{

    protected $table = "villages";
    protected $fillable = ['namevillage', 'rememberToken', 'idMunicipality'];
    protected $primaryKey = 'idVillage';

    //Relations
    public function Municipality()
    {
        return $this->belongsTo('App\Models\Municipality', 'idMunicipality', 'idMunicipality');
    }

}
