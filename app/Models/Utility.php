<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    //Attributes
    protected $table = "Utilities";
    protected $fillable = ['egress', 'entries', 'utility','period', 'idSystem'];
    protected $primaryKey = 'idUtility';

    //Relations
    public function System()
    {
        return $this->belongsTo('App\Models\System', 'idSystem', 'idSystem');
    }
}