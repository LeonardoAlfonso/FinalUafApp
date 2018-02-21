<?php

namespace App\Logic\CrumbsStrategy;

use Illuminate\Http\Request;

class ParameterStrategy implements IStrategyCrumbs
{
    public function returnParameter(Request $request)
    {
        return $request->$parameter;
    }
}
