<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlowCash extends Model
{
    //
    protected $table = "flowCash";
    protected $fillable = ['finalCash', 'period', 'idSystem'];
    protected $primaryKey = 'idFlowCash';

    //Relations
    public function System()
    {
        return $this->belongsTo('App\Models\System', 'idSystem', 'idSystem');
    }

}




