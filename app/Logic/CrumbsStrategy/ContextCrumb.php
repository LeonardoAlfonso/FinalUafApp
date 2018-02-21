<?php

namespace App\Logic\CrumbsStrategy;

use Illuminate\Http\Request;

class ContextCrumb
{
    public $Strategy = NULL;

    public function __construct(Request $request)
    {
        if($request->has('Departament'))
        {
            $this->Strategy = new ParameterStrategy();
        }
        else
        {
            $this->Strategy = new QueryStrategy();
        }
    }

    public function executeStrategy(Request $request)
    {
        return $this->$Strategy->returnParameter($request);
    }

}
