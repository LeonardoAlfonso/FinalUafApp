<?php

namespace App\Logic\CrumbsStrategy;

use Illuminate\Http\Request;

interface IStrategyCrumbs
{
    public function returnParameter(Request $request);
}
